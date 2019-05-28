/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GestioEmpreses;

import Connexio.Connexio;
import static Login.Login.neteja;
import GestioEmpreses.Gestio;
import static GestioEmpreses.Gestio.crear_missatge;
import java.awt.BorderLayout;
import java.awt.Font;
import java.awt.GridLayout;
import java.awt.LayoutManager;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;

/**
 *
 * @author Kevin
 * @brief Clase Afegir_Modificar on s'implementen les funcions d'afegir o editar depenent de com ha siguit cridat en la clase Gestio
 */
public class Afegir_Modificar {
    static JFrame fAccio = null;
    static JPanel pTop = new JPanel();
    static JPanel pCenter = new JPanel();
    static JPanel pBottom = new JPanel();
    static int id_empresa;
    static LayoutManager l=new GridLayout(8,2);
    static JButton btnAccio=new JButton();
    static JComboBox selVia=new JComboBox<>(new String[]{"Via","Carrer","Avinguda"});
    static String [] valorsLabel={"Nom","Tipus via","Adreça","Número","Població","Correu electrònic","Usuari","Contrasenya"};
    static JTextField filtres[]=new JTextField[valorsLabel.length-1];
    
    /**
     * Constructor de la clase Afegir_Modificar 
     * @param empresa si el valor és diferent a 0 entra en mode 'Editar' en cas contrari, el mètode es 'Afegir'
     */
    public Afegir_Modificar(int empresa) {
        crear_interficie(empresa);
        set_escoltador();
    }
    
    /**
     * Mètode que crea l'interficie gràfica de la clase Afegir_Modificar
     * @param empresa si té valor 0 els camps seràn buits sinó, seran plens amb l'informació obtinguda a la BDD a través de l'id empresa pasat per paràmetre
     */
    public void crear_interficie(int empresa) {
        if(fAccio==null){
            fAccio=new JFrame();
        }
        pCenter.setLayout(l);
        id_empresa=empresa;
        int i=0;
        for(String valor:valorsLabel){
            JTextField text=new JTextField();
            pCenter.add(new JLabel(valor));
            if(valor.equals("Tipus via")==true){
                pCenter.add(selVia);
            }
            else{
                if(valor.equals("Contrasenya")==true){
                    filtres[i]=new JPasswordField();
                }
                else{
                    filtres[i]=new JTextField();
                }
                pCenter.add(filtres[i]);
                i++;
            }
        }
        String tipusAccio="";
        if(empresa==0){
            //afegir empresa
            tipusAccio="Afegir empresa";
        }
        else{
            tipusAccio="Modificar empresa";
            carregarDades(empresa);
        }
        fAccio.setTitle(tipusAccio);
        btnAccio.setText(tipusAccio);
        JLabel titol=new JLabel("BrisingrGaunt Productions, SL");
        titol.setFont(new Font(titol.getFont().getFontName(),Font.PLAIN,16));
        pTop.add(titol);
        fAccio.add(pTop,BorderLayout.NORTH);
        pTop.setBorder(new EmptyBorder(20,100,20,100));
        pCenter.setBorder(new EmptyBorder(20,100,20,100));
        fAccio.add(pCenter,BorderLayout.CENTER);
        pBottom.add(btnAccio);
        pBottom.setBorder(new EmptyBorder(20,100,20,100));
        fAccio.add(pBottom,BorderLayout.SOUTH);
        fAccio.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        fAccio.pack();
        fAccio.setSize(550, 500);
        fAccio.setLocationRelativeTo(null);
        fAccio.setVisible(true);
        fAccio.setResizable(false);
    }
    
    /**
     * Col·loca un escoltador a l'únic botó de l'aplicació
     */
    private void set_escoltador() {
        btnAccio.addActionListener(new ActionListener(){
            @Override
            public void actionPerformed(ActionEvent e){
                boolean correcte=comprovar_camps();
                if(correcte){
                    try {
                        String sql="";
                        Connection con=new Connexio().getConnexio();
                        if(id_empresa==0){
                            sql="insert into empresa (nom, tipusVia, direccio, numDireccio, comarca, email, username, password) values (?,?,?,?,?,?,?,?)";
                        }
                        else{
                            sql="update empresa set nom=?, tipusVia=?, direccio=?, numDireccio=?, comarca=?, email=?, username=?, password=? where id=?";
                        }
                        PreparedStatement st = con.prepareStatement(sql);
                        
                        //Lliguem els valors del formulari
                        String valors_formulari[]=new String[filtres.length];
                        int i=1;
                        for(JTextField filtre:filtres){
                           
                            if(i==2){
                                //Agafem el valor del dropdown
                                st.setString(i,String.valueOf(selVia.getSelectedItem()));
                                i++;                                
                            }
                            st.setString(i, filtre.getText());
                            i++;
                        }
                        if(id_empresa!=0){
                            //Si estem modificant passem l'últim paràmetre (el del where)
                            st.setString(9,String.valueOf(id_empresa));
                        }
                        int n=st.executeUpdate();
                        String accio=id_empresa==0?"Inserció":"Modificació";
                        con.close();
                        st.close();
                        if(n==1){
                            Gestio.crear_missatge(accio+" realitzada correctament.", 1);
                        }
                        else{
                            Gestio.crear_missatge("Error al realitzar "+accio+".", 0);
                        }
                       fAccio.setVisible(false);
                       Gestio.estatInicialTaulaEmpreses();
                       Gestio.fGestio.setVisible(true);
                    } catch (SQLException ex) {
                        Logger.getLogger(Afegir_Modificar.class.getName()).log(Level.SEVERE, null, ex);
                    }
                }
            }
        });
    }
    
    /**
     * Mètode que comprova que el contingut dels JTextFields siguin els adequats
     * @return true si el contingut dels JTextField ha pasat per les expressions regulars amb èxit o fals si no s'ha trobat cap coincidència
     */
    private boolean comprovar_camps(){
        String expressions[]={"^\\w{5,}","^\\d","^[\\w\\.]{6,}@\\w{4,}\\.[a-z]{2,5}$","^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(?=\\S+$).{8,}$"};
        String errors[]={"Nom","Adreça","Número","Població","Correu electrònic","Usuari","La contrasenya ha d'incloure 1 majúscula, 1 minúscula, 1 número, 1 símbol, no pot tenir espais i llargària mínima de 8 caràcters"};
        int posicio=0;
        int i=0;
        boolean correcte=true;
        String validacio="Hi ha errors en els següents camps: ";
        for(JTextField filtre:filtres){
            if(posicio%2==0 && posicio!=0){
                i=posicio/2;
            }
            else{
                i=0;
            }
            Pattern p=Pattern.compile(expressions[i]);
            Matcher m=p.matcher(filtre.getText());
            if(!m.find()){
                correcte=false;
                validacio+="\n\t - "+errors[posicio];
            }
            posicio++;        
        }
        if(!correcte){
            crear_missatge(validacio,1);
        }
        return correcte;
    }
    
    /**
     * Mètode que carrega l'informació d'una empresa en els JTextField en cas que s'entri per mètode 'Editar'
     * @param empresa id de l'empresa a recuperar les dades
     */
    public static void carregarDades(int empresa){
        try {
                //editar empresa
                //es fa el populate dels camps del formulari
                String s2="select nom, tipusVia, direccio, numDireccio, comarca, email, username, password from empresa where id like ?";
                Connection con=new Connexio().getConnexio();
                PreparedStatement st=con.prepareStatement(s2);
                st.setString(1, String.valueOf(id_empresa));
                ResultSet rs=st.executeQuery();
                //Només tornarà un registre per tant ens estalviem el bucle rs.next()
                rs.first();
                //Es selecciona l'element del dropdown
                for(int i=0;i<selVia.getItemCount();i++){
                    if(rs.getString(2).equals(selVia.getItemAt(i))==true){
                        selVia.setSelectedIndex(i);
                    }
                }
                //S'omplen els JTextField
                int j=3;
                for(int i=0;i<filtres.length;i++){
                    if(i!=0){
                       filtres[i].setText(rs.getString(j));
                        j++;
                    }
                    else{
                        filtres[i].setText(rs.getString((i+1)));
                        
                    }
                }  
                con.close();
                rs.close();
            } catch (SQLException ex) {
                Logger.getLogger(Afegir_Modificar.class.getName()).log(Level.SEVERE, null, ex);
            }
    }
    
    /**
     * Canvia l'estat de l'instància de la clase Afegir_Modificar, és un mètode emprat en la clase Gestió
     * @param empresa 
     */
    public static void setEstat(int empresa){
        id_empresa=empresa;
        if(empresa==0){
            for(JTextField camp: filtres){
                camp.setText("");  
            }
            btnAccio.setText("Afegir empresa");
        }
        else{
            carregarDades(empresa);
            btnAccio.setText("Modificar empresa");
        }
    }
}
