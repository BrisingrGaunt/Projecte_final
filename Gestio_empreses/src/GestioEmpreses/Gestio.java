/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GestioEmpreses;

import Connexio.Connexio;
import java.awt.BorderLayout;
import java.awt.Component;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridLayout;
import java.awt.Point;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
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
import javax.swing.table.TableCellRenderer;
import javax.swing.table.TableColumn;


/**
 *
 * @author Kevin
 * @brief Clase que permet realitzar les operaciones CRUD sobre la taula empresa de la Base de dades\n mostra també
 * les cates associades a l'empresa
 */
public final class Gestio {
    static JFrame fGestio = new JFrame("Gestió empreses -- Info empreses");
    JPanel pBottom = new JPanel();
    JPanel pTop= new JPanel();
    JPanel pLeft = new JPanel();
    JPanel pRight = new JPanel();
    JTextField filtre=new JTextField(30);
    static DefaultTableModel modelEmpreses;
    static DefaultTableModel modelTasts;
    static JTable taulaEmpreses;
    JTable taulaTasts;
    String[] nomColumEmpreses = {"CIF","Nom comercial","Adreça","Tasts realitzats"};
    String[] nomColumnTasts={"Empresa","Producte","Dia i hora","Valoració mitja"};
    static Object[][] dataEmpreses=null;
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
    static JButton btnCercaUbicacio = new JButton();
    
    
    //Elements bottom
    JLabel cifLabel;
    JLabel nomLabel;
    JLabel adrecaLabel;
    JLabel countLabel;
    
    JTextField cif;
    JTextField nom;
    JTextField adreca;
    
    /**
     * Constructor de la clase Gestio
     * utilitza els mètodes crear_interficie i set_escoltadors
     * @see crear_interficie()
     * @see set_escoltadors()
     */
    public Gestio() {
        this.crear_interficie();  
        this.set_escoltadors();
    }
    
    /**
     * Funció que realitza la part gràfica de la clase Gestio
     */
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
        btnCerca.setActionCommand("nom");
        pTop.add(btnCerca);
        btnCercaUbicacio.setIcon(new ImageIcon("./ubicate.png"));
        btnCercaUbicacio.setActionCommand("ubicacio");
        pTop.add(btnCercaUbicacio);
        btnReset.setIcon(new ImageIcon("./reset1.png"));
        pTop.add(btnReset);
        
        fGestio.add(pTop,BorderLayout.NORTH);
      
        //Panell dreta
        pRight.setLayout(new GridLayout(14,1));
        btnAfegir.setFont(new Font(btnAfegir.getFont().getFontName(),Font.BOLD,16));
        pRight.add(btnAfegir);
        pRight.add(btnEditar);
        pRight.add(btnEsborrar);
        pRight.setBorder(BorderFactory.createEmptyBorder(20, 0, 0, 20)); 
        fGestio.add(pRight,BorderLayout.EAST);
        
        //Finalització del JFrame
        fGestio.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        //f.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        fGestio.pack();
        fGestio.setSize(900, 500);
        fGestio.setLocationRelativeTo(null);
        fGestio.setVisible(true);
        fGestio.setResizable(false);
    }
    
    /**
     * Funció que crea un objecte JTable a partir d'un string
     * @param nom_taula indica el nom que tindrà l'objecte JTable un cop creat
     */
    public void crear_taula(String nom_taula){
        JTable taula=new JTable();
        DefaultTableModel model=new DefaultTableModel();
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
                JScrollPane.HORIZONTAL_SCROLLBAR_NEVER
        );
        
        //Assignació de scroll a la taulaEmpreses per defecte
        scroll.setPreferredSize(new Dimension(700,150));
        pLeft.setBorder(BorderFactory.createEmptyBorder(20, 20, 20, 20));
        pLeft.add(scroll);
        fGestio.add(pLeft,BorderLayout.CENTER); 
        if(nom_taula.equals("emp")==true){
            modelEmpreses=model;
            taulaEmpreses=taula;
        }
        else{
            modelTasts=model;
            taulaTasts=taula;
        }
    }
    /**
     * Funció que omple la taula taulaEmpreses amb les dades obtingudes a partir de l'empresa seleccionada
     */
    public void mostrarTasts(){
        try {
            //Primer es neteja la taula de Tasts
            buidar_taula(modelTasts);
            //Aquí s'obtindrien les dades de la BDD
            int fila_seleccionada=taulaEmpreses.getSelectedRow();
            //Ens quedem amb l'empresa seleccionada
            String empresa=(String)taulaEmpreses.getModel().getValueAt(fila_seleccionada, 0);            
            Connection con=new Connexio().getConnexio();
            String s2="select c.empresa, p.nom, c.data, avg(pa.valoracio) from producte p, cata c, participacio pa where p.codi=c.producte and pa.cata=c.id and c.empresa like ? and pa.valoracio is not null group by c.empresa, p.nom, c.data";
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
    
    /**
     * Funció que esborra l'informació del model que es pasa per paràmetre
     * @param model Model en el que s'eliminarà les dades
     */
    static void buidar_taula(DefaultTableModel model){
        int i=model.getRowCount();
        while(model.getRowCount()!=0){
            model.removeRow(i-1);
            i--;
        }
    }
    /**
     * Funció privada que assigna els events als botons creats
     */
    private void set_escoltadors() {
        btnCerca.addActionListener(new clickCercar());
        btnCercaUbicacio.addActionListener(new clickCercar());
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
    
    //ESCOLTADORS
    
    /**
     * Clase que s'utilitza per deixar l'aplicatiu a l'estat inicial
     * @implements ActionListener
     */
    private class clickReset implements ActionListener{

        @Override
        public void actionPerformed(ActionEvent e) {
            estatInicialTaulaEmpreses();
            filtre.setText("");
        }
    }
    
    /**
     * Clase que obre una instància de l'objecte Afegir_Modificar en mode afegir
     * @implements ActionListener
     */
    public class clickAfegir implements ActionListener{

        @Override
        public void actionPerformed(ActionEvent e) {
            fGestio.setVisible(false);
            if(Afegir_Modificar.fAccio==null){
                new Afegir_Modificar(0);
            }
            else{
                Afegir_Modificar.setEstat(0);
                Afegir_Modificar.fAccio.setVisible(true);
            }
        }
    }
    
    /**
     * Clase que filtra
     * @implements ActionListener
     */
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
                    //es mostren només els que coincideixen amb el tipus de filtre
                    int elements=0;
                    for(int i=0;i<dataEmpreses.length;i++){
                        //si s'ha clicat el botó de la lupa es cerca per nom sinó es cerca pel camp de direcció   
                        String colReferencia=e.getActionCommand()=="nom"?String.valueOf(dataEmpreses[i][1]):String.valueOf(dataEmpreses[i][2]);
                        if(colReferencia.toLowerCase().indexOf(filtre.getText().toLowerCase())!=-1){
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

    /**
     * Clase que obre un objecte del tipus Afegir_Modificar en format editar
     * @implements ActionListener
     */
    public class clickEditar implements ActionListener{

        @Override
        public void actionPerformed(ActionEvent e) {
            int fila_seleccionada=taulaEmpreses.getSelectedRow();
            if(fila_seleccionada==-1){
                crear_missatge("Selecciona la fila que vols editar primer", ERROR_MESSAGE);
            }
            else{
                fGestio.setVisible(false);
                String empresa=(String)taulaEmpreses.getModel().getValueAt(fila_seleccionada, 0);
                if(Afegir_Modificar.fAccio==null){
                    new Afegir_Modificar(Integer.parseInt(empresa));
                }
                else{
                    Afegir_Modificar.setEstat(Integer.parseInt(empresa));
                    Afegir_Modificar.fAccio.setVisible(true);
                }
            }
        }
    }
    
    /**
     * Clase que permet esborrar una fila de la taulaEmpreses 
     * @implements ActionListener
     */
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
            }
        }
    }
    //ÚTILS
    
    /**
     * Funció que deixa l'aplicatiu al seu estat original (sense mostrar la taula de tasts i netejant possibles filtres aplicats a la taula d'empreses)
     */
    public static void estatInicialTaulaEmpreses(){
        try {
            buidar_taula(modelEmpreses);
            buidar_taula(modelTasts);
            Connection con=new Connexio().getConnexio();
            Statement st = con.createStatement();
            String sql="select e.id, e.nom, tasts.realitzats, e.tipusVia, e.direccio, e.numDireccio, e.comarca from empresa e left join (select count(c.id) as realitzats, e.id as emp from empresa e left join cata c on c.empresa=e.id where estat=1 group by e.id) as tasts on tasts.emp=e.id where e.visibilitat=0 order by tasts.realitzats desc";
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
                for(int j=1;j<3;j++){
                    dataEmpreses[k][(j-1)]=rs.getString(j);
                }
                String direccio=rs.getString(4)+" "+rs.getString(5)+", "+rs.getString(6)+" ("+rs.getString(7)+")";
                dataEmpreses[k][2]=direccio;
                dataEmpreses[k][3]=rs.getString(3)==null?"0":rs.getString(3);
                k++;
            }
            rs.close();
            con.close();
            //omplim la taula
            for(int i=0;i<dataEmpreses.length;i++){             
                modelEmpreses.insertRow(i, dataEmpreses[i]);
            }
            //ajustem la mida de les cel·les
            ajustarTaula(taulaEmpreses);
        } catch (SQLException ex) {
            crear_missatge("Error al executar la consulta de selecció d'empreses", ERROR_MESSAGE);
        }
    }
    
    /**
     * Funció que ajusta el contingut d'una taula en funció al contingut de les seves cel·les
     * @param taula Taula a ajustar
     */
    static void ajustarTaula(JTable taula){
        taula.setAutoResizeMode( JTable.AUTO_RESIZE_OFF );

        for (int column = 0; column < taula.getColumnCount(); column++)
        {
            TableColumn tableColumn = taula.getColumnModel().getColumn(column);
            int preferredWidth = tableColumn.getMinWidth();
            int maxWidth = tableColumn.getMaxWidth();

            for (int row = 0; row < taula.getRowCount(); row++)
            {
                TableCellRenderer cellRenderer = taula.getCellRenderer(row, column);
                Component c = taula.prepareRenderer(cellRenderer, row, column);
                int width = c.getPreferredSize().width + taula.getIntercellSpacing().width;
                preferredWidth = Math.max(preferredWidth, width);
                if (preferredWidth >= maxWidth)
                {
                    preferredWidth = maxWidth;
                    break;
                }
            }
            tableColumn.setPreferredWidth( preferredWidth<100?preferredWidth+74:preferredWidth+73 );
        }
    }
    
    /**
     * Funció que determina si un JTextField està buit o no
     * @param jt JTextField a comprovar
     * @return false si el JTextField és buit o true si està ple
     */
    private boolean es_buit(JTextField jt){
        return jt.getText().length()==0;
    }
    
    /**
     * Funció que crea un popup de missatge
     * @param missatge cadena que indica el contingut del missatge
     * @param tipus pot prendre tres valors: 0 Error, 1 Informació, 2 Warning
     */
    public static void crear_missatge(String missatge, int tipus){
        JOptionPane info=new JOptionPane();
        info.setMessage(missatge);
        info.setMessageType(tipus);
        JDialog dialog = info.createDialog(null, "Informació");
        dialog.setVisible(true);
    }
    
    /**
     * Mètode que transforma la valoració numèrica en string d'estrelles
     * @param valoracio número d'estrelles que té la valoració mínim 0 màxim 5
     * @return cadena d'estrelles formada
     */
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
