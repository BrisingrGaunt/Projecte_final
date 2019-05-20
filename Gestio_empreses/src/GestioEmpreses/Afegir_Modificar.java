/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GestioEmpreses;

import Connexio.Connexio;
import static Login.Login.neteja;
import GestioEmpreses.Gestio;
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
 */
public class Afegir_Modificar {
    JFrame f = new JFrame();
    JPanel pTop = new JPanel();
    JPanel pCenter = new JPanel();
    JPanel pBottom = new JPanel();
    int id_empresa;
    LayoutManager l=new GridLayout(7,2);
    static JButton btnAccio=new JButton();
    JComboBox selVia=new JComboBox<>(new String[]{"Via","Carrer","Avinguda"});
    String [] valorsLabel={"Nom","Tipus via","Adreça","Número","Correu electrònic","Usuari","Contrasenya"};
    JTextField filtres[]=new JTextField[valorsLabel.length-1];
    
    public Afegir_Modificar(int empresa) {
        crear_interficie(empresa);
        set_escoltador();
    }

    private void crear_interficie(int empresa) {
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
            try {
                //editar empresa
                tipusAccio="Modificar empresa";
                //es fa el populate dels camps del formulari
                String s2="select nom, tipusVia, direccio, numDireccio, email, username, password from empresa where id like ?";
                Connection con=new Connexio().getConnexio();
                PreparedStatement st=con.prepareStatement(s2);
                st.setString(1, String.valueOf(id_empresa));
                ResultSet rs=st.executeQuery();
                //Només tornarà un registre per tant ens estalviem el bucle rs.next()
                rs.first();
                //Es selecciona l'element del dropdown
                for(i=0;i<selVia.getItemCount();i++){
                    if(rs.getString(2).equals(selVia.getItemAt(i))==true){
                        selVia.setSelectedIndex(i);
                    }
                }
                //S'omplen els JTextField
                int j=3;
                for(i=0;i<filtres.length;i++){
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
        f.setTitle(tipusAccio);
        btnAccio.setText(tipusAccio);
        id_empresa=empresa;
        JLabel titol=new JLabel("BrisingrGaunt Productions, SL");
        titol.setFont(new Font(titol.getFont().getFontName(),Font.PLAIN,16));
        pTop.add(titol);
        //label.setFont(new Font(label.getFont().getFontName(),Font.PLAIN,16));
        f.add(pTop,BorderLayout.NORTH);
        pTop.setBorder(new EmptyBorder(20,100,20,100));
        pCenter.setBorder(new EmptyBorder(20,100,20,100));
        f.add(pCenter,BorderLayout.CENTER);
        
        pBottom.add(btnAccio);
        pBottom.setBorder(new EmptyBorder(20,100,20,100));
        f.add(pBottom,BorderLayout.SOUTH);
        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        f.pack();
        f.setSize(550, 500);
        f.setLocationRelativeTo(null);
        f.setVisible(true);
        f.setResizable(false);
    }

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
                            sql="insert into empresa (nom, tipusVia, direccio, numDireccio, email, username, password) values (?,?,?,?,?,?,?)";
                        }
                        else{
                            sql="update empresa set nom=?, tipusVia=?, direccio=?, numDireccio=?, email=?, username=?, password=? where id=?";
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
                            st.setString(8,String.valueOf(id_empresa));
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
                        //f.dispose();
                        //System.exit(0);
                       f.setVisible(false);
                       f.dispose();
                        //Gestio g=new Gestio();
                    } catch (SQLException ex) {
                        Logger.getLogger(Afegir_Modificar.class.getName()).log(Level.SEVERE, null, ex);
                    }
                }else{
                    //control d'errors de validació de formulari
                }
            }
        });
    }
    
    private boolean comprovar_camps(){
//        for(JTextField filtre:filtres){
//            if(filtre.getText().length()==0){
//                return false;
//            }
//        }
        return true;
    }
    
    
}
