/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GestioEmpreses;

import Connexio.Connexio;
import java.awt.BorderLayout;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridLayout;
import java.awt.Point;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Time;
import java.sql.Timestamp;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.BorderFactory;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import static javax.swing.JOptionPane.ERROR_MESSAGE;
import static javax.swing.JOptionPane.INFORMATION_MESSAGE;
import static javax.swing.JOptionPane.WARNING_MESSAGE;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.JTextField;
import javax.swing.table.DefaultTableModel;


/**
 *
 * @author Kevin
 */
public final class Gestio {
    JFrame f = new JFrame("Gestió empreses -- Info empreses");
    JPanel pBottom = new JPanel();
    JPanel pTop= new JPanel();
    JPanel pLeft = new JPanel();
    JPanel pRight = new JPanel();
    JTextField filtre=new JTextField(30);
    DefaultTableModel modelEmpreses;
    DefaultTableModel modelTasts;
    JTable taulaEmpreses;
    JTable taulaTasts;
    String[] nomColumEmpreses = {"CIF","Nom comercial","Adreça","Tasts realitzats"};
    String[] nomColumnTasts={"Empresa","Producte","Dia i hora","Valoració mitja"};
    Object[][] dataEmpreses=null;
    Object[][] dataTasts=null;
    
    Class[] columnClassTasts=new Class[]{
        String.class,String.class,String.class,String.class
    };
   
    Class[] columnClassEmpreses = new Class[] {
        String.class, String.class, String.class, Integer.class
    };
    
    //Botons
    static JButton btnEditar = new JButton("Editar");
    static JButton btnModificar = new JButton("Modificar");
    static JButton btnEsborrar = new JButton("Esborrar");
    static JButton btnAfegir = new JButton("+");  
    static JButton btnCerca = new JButton();
    static JButton btnReset = new JButton();
    
    
    //Elements bottom
    JLabel cifLabel;
    JLabel nomLabel;
    JLabel adrecaLabel;
    JLabel countLabel;
    
    JTextField cif;
    JTextField nom;
    JTextField adreca;

    public Gestio() {
        this.crear_interficie();  
        this.set_escoltadors();
    }
    
    public void crear_interficie(){
        //Inicialització de les taules
        crear_taula("emp");
        crear_taula("tasts");
        // Omplir de dades la taulaEmpreses 
        estatInicialTaulaEmpreses();
            
        //Panell superior
        pTop.setBorder(BorderFactory.createEmptyBorder(30, 20, 20, 20));
        pTop.add(new JLabel("Cercar per nom: "));
        pTop.add(filtre);
        btnCerca.setIcon(new ImageIcon("./lupa.png"));
        pTop.add(btnCerca);
        btnReset.setIcon(new ImageIcon("./reset1.png"));
        pTop.add(btnReset);
        
        f.add(pTop,BorderLayout.NORTH);
      
        //Panell dreta
        pRight.setLayout(new GridLayout(14,1));
        btnAfegir.setFont(new Font(btnAfegir.getFont().getFontName(),Font.BOLD,16));
        pRight.add(btnAfegir);
        pRight.add(btnEditar);
        pRight.add(btnEsborrar);
        pRight.setBorder(BorderFactory.createEmptyBorder(20, 0, 0, 20)); 
        f.add(pRight,BorderLayout.EAST);
        
        //Finalització del JFrame
        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        f.pack();
        f.setSize(900, 500);
        f.setLocationRelativeTo(null);
        f.setVisible(true);
        f.setResizable(false);
    }
    
    public void crear_taula(String nom_taula){
        JTable taula=new JTable();
        DefaultTableModel model=new DefaultTableModel();
        //modelEmpreses=new DefaultTableModel();
        taula=new JTable(model){
            @Override
            public boolean isCellEditable(int row, int column){
                //cap fila/columna és editable
                return false;
            }
            
            @Override
            //Retorna el tipus de dada de la columna pasada per paràmetre
            public Class<?> getColumnClass(int column){
               Class x=nom_taula.equals("emp")==true? columnClassEmpreses[column]: columnClassTasts[column];
               return x;
            }
        };
        //Es crea la capçalera de la taula que toqui
        String[] noms=nom_taula.equals("emp")==true?nomColumEmpreses:nomColumnTasts;
        for(String n:noms){
            model.addColumn(n);
        }
        
        //Assignació de scroll a la taulaEmpreses (tant com necessiti)
        JScrollPane scroll=new JScrollPane(
                taula,
                JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED,
                JScrollPane.HORIZONTAL_SCROLLBAR_AS_NEEDED
        );
        
        //Assignació de scroll a la taulaEmpreses per defecte
        scroll.setPreferredSize(new Dimension(700,150));
        pLeft.setBorder(BorderFactory.createEmptyBorder(20, 20, 20, 20));
        pLeft.add(scroll);
        f.add(pLeft,BorderLayout.CENTER); 
        if(nom_taula.equals("emp")==true){
            modelEmpreses=model;
            taulaEmpreses=taula;
        }
        else{
            modelTasts=model;
            taulaTasts=taula;
        }
    }

    public void mostrarTasts(){
        try {
            //Primer es neteja la taula de Tasts
            buidar_taula(modelTasts);
            //Aquí s'obtindrien les dades de la BDD
            int fila_seleccionada=taulaEmpreses.getSelectedRow();
            //Ens quedem amb l'empresa seleccionada
            String empresa=(String)taulaEmpreses.getModel().getValueAt(fila_seleccionada, 0);            
            Connection con=new Connexio().getConnexio();
            String s2="select c.empresa, p.nom, c.data, avg(pa.valoracio) from producte p, cata c, participacio pa where p.codi=c.producte and pa.empresa=c.empresa and pa.cata=c.id and c.empresa like ? group by c.empresa, p.nom, c.data";
            PreparedStatement st = con.prepareStatement(s2);
            st.setString(1,empresa);
            ResultSet rs = st.executeQuery();
            rs.last();
            //Obtenim la quantitat de resultats per generar la taula
            int qt_resultats=rs.getRow();
            dataTasts=new Object[qt_resultats][4];
            rs.beforeFirst();
            int j=0;
            while(rs.next()){
                for(int i=0;i<4;i++){
                    if(i==2){
                        SimpleDateFormat sdf=new SimpleDateFormat("dd/MM/yyyy HH:mm");
                        dataTasts[j][i]=sdf.format(rs.getTimestamp(3));
                    }
                    else if(i==3){
                        dataTasts[j][i]=valoracio_to_stars(rs.getInt(4));
                    }
                    else{
                        dataTasts[j][i]=rs.getString((1+i));
                    }
                }
                modelTasts.insertRow(j, dataTasts[j]);
                j++;
            }
            if(j==0){
                crear_missatge("Aquesta empresa no ha realitzat cap tast encara.",WARNING_MESSAGE);
            }
            con.close();
        } catch (SQLException ex) {
            Logger.getLogger(Gestio.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    private void buidar_taula(DefaultTableModel model){
        int i=model.getRowCount();
        while(model.getRowCount()!=0){
            model.removeRow(i-1);
            i--;
        }
    }
    
    private void set_escoltadors() {
        btnCerca.addActionListener(new clickCercar());
        btnReset.addActionListener(new clickReset());
        btnEditar.addActionListener(new clickEditar());
        btnAfegir.addActionListener(new clickAfegir());
        btnEsborrar.addActionListener(new clickEsborrar());
        taulaEmpreses.addMouseListener(new MouseAdapter(){
            @Override
            public void mousePressed(MouseEvent mouseEvent){
                Point point=mouseEvent.getPoint();
                if(mouseEvent.getClickCount()==2 && taulaEmpreses.getSelectedRow()!=-1){
                    mostrarTasts();
                } 
            }
        });
    }
    /*static JButton btnEditar = new JButton("Editar");
    static JButton btnModificar = new JButton("Modificar");
    static JButton btnEsborrar = new JButton("Esborrar");
    static JButton btnAfegir = new JButton("+");
    static JButton btnAlta = new JButton("Alta");   
    static JButton btnCerca = new JButton();*/
    
    //ESCOLTADORS
    private class clickReset implements ActionListener{

        @Override
        public void actionPerformed(ActionEvent e) {
            estatInicialTaulaEmpreses();
            filtre.setText("");
        }
    
    }
    public class clickAfegir implements ActionListener{

        @Override
        public void actionPerformed(ActionEvent e) {
            f.dispose();
            new Afegir_Modificar(0);
        }
    }
    
    public class clickCercar implements ActionListener{

        @Override
        public void actionPerformed(ActionEvent e) {
            if(es_buit(filtre)){
                crear_missatge("Indica algun contingut per cercar", ERROR_MESSAGE);
            }
            else{
                if(filtre.getText().length()<4){
                    crear_missatge("Si us plau, indica mínim 4 paraules per poder realitzar la cerca.",INFORMATION_MESSAGE);
                }
                else{
                    //Primer es buiden les dues taules
                    buidar_taula(modelEmpreses);
                    buidar_taula(modelTasts);
                    //se tendrán que mostrar solo los que coinciden con el filtro
                    int elements=0;
                    for(int i=0;i<dataEmpreses.length;i++){
                        String nom_comercial=String.valueOf(dataEmpreses[i][1]);
                        if(nom_comercial.toLowerCase().indexOf(filtre.getText().toLowerCase())!=-1){
                            modelEmpreses.insertRow(elements, dataEmpreses[i]);
                            elements++;
                        }  
                    }
                    if(elements==0){
                        crear_missatge("No s'ha trobat cap coincidència",WARNING_MESSAGE);
                        estatInicialTaulaEmpreses();
                    }
                }
            }
        }
    }

    public class clickEditar implements ActionListener{

        @Override
        public void actionPerformed(ActionEvent e) {
            int fila_seleccionada=taulaEmpreses.getSelectedRow();
            if(fila_seleccionada==-1){
                crear_missatge("Selecciona la fila que vols editar primer", ERROR_MESSAGE);
            }
            else{
                f.dispose();
                String empresa=(String)taulaEmpreses.getModel().getValueAt(fila_seleccionada, 0);
                new Afegir_Modificar(Integer.parseInt(empresa));
            }
        }
    }
    
    public class clickEsborrar implements ActionListener{
        @Override
        public void actionPerformed(ActionEvent e) {
            int fila_seleccionada=taulaEmpreses.getSelectedRow();
            if(fila_seleccionada==-1){
                crear_missatge("Selecciona la fila que vols esborrar primer", ERROR_MESSAGE);
            }
            else{
                String qt_tasts=String.valueOf(taulaEmpreses.getModel().getValueAt(fila_seleccionada, 3));
                boolean esborrar=false;
                if(qt_tasts.equals("0")==false){
                    int confirmacio=JOptionPane.showConfirmDialog(null, "Estàs segur de voler esborrar aquesta empresa i els seus tasts?" ,"Warning",JOptionPane.YES_NO_OPTION);
                    if(confirmacio==JOptionPane.YES_OPTION){
                        esborrar=true;
                    }
                }
                else{
                    //Si no té tasts realitzats aquesta empresa es pot eliminar
                    esborrar=true;
                }
                if(esborrar){
                    try {
                        Connection con=new Connexio().getConnexio();
                        String sql="update empresa set visibilitat=1 where id like ?";
                        PreparedStatement st = con.prepareStatement(sql);
                        //st = con.prepareStatement(sql);
                        String empresa=(String)taulaEmpreses.getModel().getValueAt(fila_seleccionada, 0);
                        st.setString(1,empresa);
                        int n=st.executeUpdate();
                        
                        if(n==1){
                            //si s'ha realitzat bé la modificació es netegen les taules i es tornen a mostrar
                            estatInicialTaulaEmpreses();
                        }
                        con.close();
                    } catch (SQLException ex) {
                        Logger.getLogger(Gestio.class.getName()).log(Level.SEVERE, null, ex);
                    }
                }
                //model.setValueAt(Integer.parseInt(id.getText()), fila, 0);
            }
        }
    }
    //ÚTILS
    
    private void estatInicialTaulaEmpreses(){
        try {
            buidar_taula(modelEmpreses);
            buidar_taula(modelTasts);
            Connection con=new Connexio().getConnexio();
            Statement st = con.createStatement();
            String sql="select e.id, e.nom, e.direccio, count(c.id) from empresa e left join cata c on c.empresa=e.id where e.visibilitat=0 group by e.id, e.nom, e.direccio";
            ResultSet rs = st.executeQuery(sql);
            rs.last();
            //guardem la quantitat de registres per incialitzar la matriu dataEmpreses
            int qt_registres=rs.getRow();
            //ens situem al principi del resultSet
            rs.beforeFirst();
            int k=0;
            dataEmpreses=new Object[qt_registres][4];
            while(rs.next()){
                //omplim les dades obtingudes a la select
                for(int j=1;j<5;j++){
                    dataEmpreses[k][(j-1)]=rs.getString(j);
                }
                k++;
            }
            rs.close();
            con.close();
            //omplim la taula
            for(int i=0;i<dataEmpreses.length;i++){             
                modelEmpreses.insertRow(i, dataEmpreses[i]);
            }
        } catch (SQLException ex) {
            crear_missatge("Error al executar la consulta de selecció d'empreses", ERROR_MESSAGE);
        }
    }
    
    
    private boolean es_buit(JTextField jt){
        return jt.getText().length()==0;
    }
    
    /*
    Tipus:
        0 Error
        1 Informació
        2 Warning
    */
    public static void crear_missatge(String missatge, int tipus){
        JOptionPane info=new JOptionPane();
        info.setMessage(missatge);
        info.setMessageType(tipus);
        JDialog dialog = info.createDialog(null, "Error");
        dialog.setVisible(true);
    }

    private String valoracio_to_stars(int valoracio){
        String estrelles="";
        for(int i=0;i<valoracio;i++){
            estrelles+="★";
        }
        for(int i=valoracio;i<5;i++){
            estrelles+="☆";
        }
        return estrelles;
    }
}
