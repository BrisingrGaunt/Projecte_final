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
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.BorderFactory;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import static javax.swing.JOptionPane.ERROR_MESSAGE;
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
    DefaultTableModel model; // ============ DEFINIR TAULA ==========
    JTable taula;
    String nomColum[] = {"CIF","Nom comercial","Adreça","Tasts realitzats"};
    Object[][] data = new Object[][] {
            {"E1XO", "Arya's Feasts", "The House of Black & White, Bravos", 2},
            {"LSDX", "Bey's Homecoming", "Houston, Texas baby!", 4},
            {"MEDE12", "Hogwarts's free Elves", "The kitchens, Hogwarts", 0 }
        };
   
    Class[] columnClass = new Class[] {
        String.class, String.class, String.class, Integer.class
    };
    
    //Botons
    static JButton btnEditar = new JButton("Editar");
    static JButton btnModificar = new JButton("Modificar");
    static JButton btnEsborrar = new JButton("Esborrar");
    static JButton btnAfegir = new JButton("+");
    static JButton btnAlta = new JButton("Alta");   
    static JButton btnCerca = new JButton();
    
    
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
                //Inicialització de la taula
        model=new DefaultTableModel();
        taula=new JTable(model){
            @Override
            public boolean isCellEditable(int row, int column){
                //cap fila/columna és editable
                return false;
            }
            
            @Override
            //Retorna el tipus de dada de la columna pasada per paràmetre
            public Class<?> getColumnClass(int column){
                return columnClass[column];
            }
        };
        //Es crea la capçalera de la taula
        for (String nomColum1 : nomColum) {
            model.addColumn(nomColum1);
        }
        
        // Omplir de dades la taula 
        // S'haurà de llegir de BDD!!!
        for(int i=0;i<data.length;i++){
            model.insertRow(i, data[i]);
        }
        
        
        //Panell superior
        pTop.setBorder(BorderFactory.createEmptyBorder(30, 20, 20, 20));
        pTop.add(new JLabel("Cercar per nom: "));
        pTop.add(filtre);
        btnCerca.setIcon(new ImageIcon("./lupa.png"));
        pTop.add(btnCerca);
        
        f.add(pTop,BorderLayout.NORTH);
        //Panell esquerra
        
        //Assignació de scroll a la taula (tant com necessiti)
        JScrollPane scroll=new JScrollPane(
                taula,
                JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED,
                JScrollPane.HORIZONTAL_SCROLLBAR_AS_NEEDED
        );
        //Assignació de scroll a la taula per defecte
        scroll.setPreferredSize(new Dimension(700,200));
        
        pLeft.setBorder(BorderFactory.createEmptyBorder(20, 20, 20, 20)); 
        pLeft.add(scroll);
        f.add(pLeft, BorderLayout.CENTER);
        
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

    private void set_escoltadors() {
        btnCerca.addActionListener(new clickCercar());
        btnEditar.addActionListener(new clickEditar());
        btnEsborrar.addActionListener(new clickEsborrar());
    }
    /*static JButton btnEditar = new JButton("Editar");
    static JButton btnModificar = new JButton("Modificar");
    static JButton btnEsborrar = new JButton("Esborrar");
    static JButton btnAfegir = new JButton("+");
    static JButton btnAlta = new JButton("Alta");   
    static JButton btnCerca = new JButton();*/
    private boolean es_buit(JTextField jt){
        return jt.getText().length()==0;
    }
    
    private void crear_missatge_error(String missatge){
        JOptionPane info=new JOptionPane();
        info.setMessage(missatge);
        info.setMessageType(ERROR_MESSAGE);
        JDialog dialog = info.createDialog(null, "ERROR");
        dialog.setVisible(true);
    }

    //ESCOLTADORS
    
    public class clickCercar implements ActionListener{

        @Override
        public void actionPerformed(ActionEvent e) {
            if(es_buit(filtre)){
                crear_missatge_error("Indica algun contingut per cercar");
            }
            else{
                System.out.println(filtre.getText());
                //se tendrán que mostrar solo los que coinciden con el filtro
            }
        }
    }
    
    public class clickEditar implements ActionListener{

        @Override
        public void actionPerformed(ActionEvent e) {
            int fila_seleccionada=taula.getSelectedRow();
            if(fila_seleccionada==-1){
                crear_missatge_error("Selecciona la fila que vols editar primer");
            }
            else{
                System.out.println(fila_seleccionada);
            }
        }
    }
    
    public class clickEsborrar implements ActionListener{
        @Override
        public void actionPerformed(ActionEvent e) {
            int fila_seleccionada=taula.getSelectedRow();
            if(fila_seleccionada==-1){
                crear_missatge_error("Selecciona la fila que vols esborrar primer");
            }
            else{
                System.out.println(fila_seleccionada);
                int aux=(Integer)taula.getModel().getValueAt(fila_seleccionada, 3);
                System.out.println(aux);
                //model.setValueAt(Integer.parseInt(id.getText()), fila, 0);
            }
        }
    }

}
