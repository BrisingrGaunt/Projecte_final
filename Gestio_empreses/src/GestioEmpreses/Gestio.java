/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GestioEmpreses;

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
import java.util.Date;
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
    String[] nomColumnTasts={"Empresa","Producte","Dia i hora","Valoració"};
    Object[][] dataEmpreses = new Object[][] {
        {"E1XO", "Arya's Feasts", "The House of Black & White, Bravos", 3},
        {"LSDX", "Bey's Homecoming", "Houston, Texas baby!", 1},
        {"MEDE12", "Hogwarts's free Elves", "The kitchens, Hogwarts", 0 }
    };
    
    Object[][] dataTasts=new Object[][]{
        {"E1XO","Patates",new Date(),4},
        {"E1XO","Acelgas",new Date(),2},
        {"E1XO","Atún",new Date(),0},
        {"LSDX","Kikos",new Date(),5}
    };
    
    Class[] columnClassTasts=new Class[]{
        String.class,String.class,Date.class,String.class
    };
   
    Class[] columnClassEmpreses = new Class[] {
        String.class, String.class, String.class, Integer.class
    };
    
    //Botons
    static JButton btnEditar = new JButton("Editar");
    static JButton btnModificar = new JButton("Modificar");
    static JButton btnEsborrar = new JButton("Esborrar");
    static JButton btnAfegir = new JButton("+");
    static JButton btnAlta = new JButton("Alta");   
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
        // S'haurà de llegir de BDD!!!
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
        //Primer es neteja la taula de Tasts
        buidar_taula(modelTasts);
        //Aquí s'obtindrien les dades de la BDD
        int fila_seleccionada=taulaEmpreses.getSelectedRow();
        //Ens quedem amb l'empresa seleccionada
        String empresa=(String)taulaEmpreses.getModel().getValueAt(fila_seleccionada, 0);
        int elements=0;
        for(int i=0;i<dataTasts.length;i++){
            if(dataTasts[i][0].equals(empresa)){
                try{
                    int valoracio=(Integer)dataTasts[i][3];
                    dataTasts[i][3]=valoracio_to_stars(valoracio);
                }catch(ClassCastException ex){
                   //Aquest problema no el tindré un cop es faci la lectura de la BDD perquè s'haurà de convertir sempre
                }
                modelTasts.insertRow(elements, dataTasts[i]);
                elements++;
            }  
        }
        if(elements==0){
            crear_missatge("Aquesta empresa no ha realitzat cap tast encara.",WARNING_MESSAGE);
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
                    System.out.println(filtre.getText());
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
                System.out.println(fila_seleccionada);
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
                //System.out.println(fila_seleccionada);
                int qt_tasts=(Integer)taulaEmpreses.getModel().getValueAt(fila_seleccionada, 3);
                //System.out.println(qt_tasts);
                if(qt_tasts>0){
                    int confirmacio=JOptionPane.showConfirmDialog(null, "Estàs segur de voler esborrar aquesta empresa i els seus tasts?" ,"Warning",JOptionPane.YES_NO_OPTION);
                    System.out.println(confirmacio);
                    if(confirmacio==JOptionPane.YES_OPTION){
                        /*
                            Se procede a eliminar de la tabla pero no de la base de datos
                            (cambiando el estado de visibilidad por ejemplo)                        
                        */
                    }
                }
                //model.setValueAt(Integer.parseInt(id.getText()), fila, 0);
            }
        }
    }
    //ÚTILS
    
    private void estatInicialTaulaEmpreses(){
        buidar_taula(modelEmpreses);
        buidar_taula(modelTasts);
        for(int i=0;i<dataEmpreses.length;i++){           
            modelEmpreses.insertRow(i, dataEmpreses[i]);             
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
    private void crear_missatge(String missatge, int tipus){
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
