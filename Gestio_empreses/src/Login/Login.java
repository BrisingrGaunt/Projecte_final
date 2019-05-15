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
 *
 * @author Kevin
 */
public class Login {
    static JFrame f;
    LayoutManager l;
    JLabel label;
    static JTextField user;
    static JPasswordField pass;
    JPanel p;
    JButton b_inici;
    JButton b_reset;
    
    public Login() {
        this.create_login();
        this.set_escoltadors();
    }

    private void create_login() {
        f=new JFrame("Gestió empreses -- Login");
        l=new GridLayout(2,2,10,10);
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
        //label.setFont(label.getFont().deriveFont(1,16));
        label.setFont(new Font(label.getFont().getFontName(),Font.PLAIN,16));
        //label.setSize(16, 16);
        p.add(label);
        pass=new JPasswordField(15);
        p.add(pass);
        //amunt - esquerra - abaix - dreta
        p.setBorder(new EmptyBorder(20,100,20,100));
        f.add(p);
        //Botons
        p=new JPanel();
        b_inici=new JButton("Inicia sessió");
        p.add(b_inici);
        b_reset=new JButton("Netejar camps");
        p.add(b_reset);
        p.setBorder(new EmptyBorder(10,0,30,0));
        f.add(p,BorderLayout.SOUTH);
       // f.
        f.setVisible(true);
        f.setResizable(false);
        f.pack();
        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        f.setLocationRelativeTo(null);    
    } 
    
    private void set_escoltadors() {
        b_reset.addActionListener(new ActionListener(){
            @Override
            public void actionPerformed(ActionEvent e){
                neteja(user);
                neteja(pass);
            }
        });
        
        b_inici.addActionListener(new ActionListener(){
            @Override
            public void actionPerformed(ActionEvent e) {
                validar_camps();
            }
        });
    }
    
    public static void neteja(JTextField t){
        t.setText("");
    }
    
    /*
        Realmente hay que validarlo aquí? Representa que lo va a leer de una BDD...
        Simplemente seria comprovar que el usuario/pass introducido sea el mismo que el de la BDD
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
            //cerrar esta ventana y abrir la de gestion de empresas
        }   
    }  
}


/*    
       //part dels botons
       p=new JPanel();
       JButton b_inici=new JButton("Inicia sessió");
       p.add(b_inici);
       JButton b_neteja=new JButton("Netejar formulari");
       p.add(b_neteja);
       JButton b_tanca=new JButton("Tancar finestra");
       p.add(b_tanca);
       f.add(p,BorderLayout.SOUTH);
       
       //escoltadors
       b_inici.addActionListener(new ActionListener(){
           public void actionPerformed(ActionEvent e){
               Pattern p=Pattern.compile("^\\w{2,10}$");//user
               Matcher m;
               String comprovacions="";
               m=p.matcher(user.getText());
               boolean correcte=true;
               if(!m.find()){//si no troba cap coincidència
                   comprovacions+="L'usuari ha de tenir entre 2 i 10 caràcters\n";
                   correcte=false;
               }
               String expressions[]={"[A-Z]","\\d","\\w{6,}"};//password
               String errors[]={"Falten majúscules","Falten números","La llargada mínima és de 6"};
               for(int i=0;i<expressions.length;i++){
                   p=Pattern.compile(expressions[i]);
                   m=p.matcher(pass.getText());
                   if(!m.find()){
                       correcte=false;
                       comprovacions+="Errors contrasenya: "+errors[i]+"\n";
                   }
               }
            
               JOptionPane info = new JOptionPane();
               if(!correcte){
                  info.setMessage(comprovacions);
                  info.setMessageType(ERROR_MESSAGE);
               }
               else{
                   info.setMessage("Molt bé, les dades són correctes.");
                   info.setMessageType(INFORMATION_MESSAGE);
                   neteja(pass);
                   neteja(user);
               }
                JDialog dialog = info.createDialog(null, "Comprovacions login");
                dialog.setVisible(true);
           }
       });
       
       b_neteja.addActionListener(new ActionListener(){
           public void actionPerformed(ActionEvent e){
               neteja(user);
               neteja(pass);
           }
       });
       
       b_tanca.addActionListener(new ActionListener(){
           public void actionPerformed(ActionEvent e){
               System.exit(0);
               //f.dispose();
           }
       });
       
       
       f.setVisible(true);
       f.setResizable(false);
       f.pack();
       f.setLocationRelativeTo(null);    
       f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
//f.add(p)
    }
    
    public static void neteja(JTextField t){
        t.setText("");
    }
    
    
    
    public static void main(String[] args) {
        // TODO code application logic here
        Login l=new Login();
    }
    
}
*/