/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Login;

import GestioEmpreses.Gestio;
import java.awt.BorderLayout;
import java.awt.Font;
import java.awt.GridLayout;
import java.awt.Insets;
import java.awt.LayoutManager;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import static javax.swing.JOptionPane.ERROR_MESSAGE;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;

/**
 * @brief Clase que comprova que l'usuari tingui accés a l'aplicació
 * @author Kevin
 */
public class Login {
    /**
     *  Camps que utilitza la classe Login 
     */
    static JFrame f;
    LayoutManager l;
    JLabel label;
    static JTextField user;
    static JPasswordField pass;
    JPanel p;
    JButton b_inici;
    JButton b_reset;
    
    /**
     * Constructor públic que crea una instància d'un objecte Login
     * @see create_login()
     * @see set_escoltadors()
     */
    public Login() {
        this.create_login();
        this.set_escoltadors();
    }
    
    /**
     * Mètode privat que crea l'interficie gràfica de l'aplicatiu
     * 
     */
    private void create_login() {
        f=new JFrame("Gestió empreses -- Login"); 
        l=new GridLayout(2,2,10,10); ///<Es crea un GridLayout de 2 files, 2 columnes i 10 d'espai>
        p=new JPanel();
        label=new JLabel("BrisingrGaunt Productions, SL");
        label.setFont(new Font(label.getFont().getFontName(),Font.PLAIN,16));
        p.add(label);
        f.add(p,BorderLayout.NORTH);
        p=new JPanel();
        p.setLayout(l);
        label=new JLabel("Usuari");
        label.setFont(new Font(label.getFont().getFontName(),Font.PLAIN,16));
        p.add(label);
        user=new JTextField(15);
        p.add(user);
        label=new JLabel("Contrasenya");
        label.setFont(new Font(label.getFont().getFontName(),Font.PLAIN,16));
        p.add(label);
        pass=new JPasswordField(15);
        p.add(pass);
        p.setBorder(new EmptyBorder(20,100,20,100));///<Es crea un borde buit en el panell amb ordre: amunt- esquerra- abaix- dreta>
        f.add(p);
        //Botons
        p=new JPanel();
        b_inici=new JButton("Inicia sessió");
        p.add(b_inici);
        b_reset=new JButton("Netejar camps");
        p.add(b_reset);
        p.setBorder(new EmptyBorder(10,0,30,0));
        f.add(p,BorderLayout.SOUTH);
        f.setVisible(true);
        f.setResizable(false);
        f.pack();
        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        f.setLocationRelativeTo(null);    
    } 
    
    /**
     * Mètode que col·loca escoltadors als botons que s'han creat prèviament a create_login
     * @see create_login()
     */
    private void set_escoltadors() {
        b_reset.addActionListener(new ActionListener(){
            @Override
            /**
             * Al botó b_reset s'aplica la funció neteja
             */
            public void actionPerformed(ActionEvent e){
                neteja(user);
                neteja(pass);
            }
        });
        
        b_inici.addActionListener(new ActionListener(){
            @Override
            /**
             * Al botó b_inici s'aplica la funció validar_camps
             */
            public void actionPerformed(ActionEvent e) {
                validar_camps();
            }
        });
    }
    
    /**
     * Funció que esborra el contingut d'un JTextField
     * @param t JTextField a esborrar
     */
    public static void neteja(JTextField t){
        t.setText("");
    }
    
    /**
     * Funció que valida que els camps estiguin plens i siguin correctes
     * si va bé crea un objecte de la clase Gestio
     * si va malament neteja els camps i informa a l'usuari
     */
    public static void validar_camps() {
        if(user.getText().toLowerCase().equals("superadmin")==false || pass.getText().equals("adminadmin")==false){
            JOptionPane info=new JOptionPane();
            info.setMessage("Usuari o contrasenya incorrecte");
            info.setMessageType(ERROR_MESSAGE);
            JDialog dialog = info.createDialog(null, "Comprovacions login");
            dialog.setVisible(true);
            neteja(user);
            neteja(pass);
        }
        else{
            f.dispose();
            Gestio g=new Gestio();
        }   
    }  
}