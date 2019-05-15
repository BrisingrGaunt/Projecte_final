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
import java.awt.LayoutManager;
import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;

/**
 *
 * @author Kevin
 */
public class Afegir_Modificar {
    JFrame f = new JFrame("Gestió empreses -- Afegir/Editar empresa");
    JPanel pTop = new JPanel();
    JPanel pCenter = new JPanel();
    JPanel pBottom = new JPanel();
    int id_empresa;
    LayoutManager l=new GridLayout(7,2);
    JTextField filtre=new JTextField(30);
    static JButton btnAccio=new JButton();
    JComboBox selVia=new JComboBox<>(new String[]{"Carrer","Via","Avinguda"});
    String [] valorsLabel={"Nom","Tipus via","Adreça","Número","Correu electrònic","Usuari","Contrasenya"};

    public Afegir_Modificar(int empresa) {
        crear_interficie(empresa);
    }

    private void crear_interficie(int empresa) {
        if(empresa==0){
            //afegir empresa
            btnAccio.setText("Afegir empresa");
        }
        else{
            //editar empresa
            btnAccio.setText("Modificar empresa");
        }
        id_empresa=empresa;
        int i=0;
        int j=0;
        pCenter.setLayout(l);
        for(String aux:valorsLabel){
            JTextField text=new JTextField();
            pCenter.add(new JLabel(aux));
            if(aux.equals("Tipus via")==true){
                pCenter.add(selVia);
            }
            else{
                pCenter.add(text);
            }
        }
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
    
    
}
