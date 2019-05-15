/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Connexio;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author Kevin Medina
 */
public class Connexio {
    Connection con = null;
    
    public Connexio() {
        try {
            String url = "jdbc:mysql://localhost:3306/projecte_kevin?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC";//?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC
            con = DriverManager.getConnection(url, "root", "");
//            System.out.println("Connectat");
//            System.out.println("Nom de la classe que facilita la connexió: "+con.getClass().getName());
            
        } catch (SQLException ex) {
            System.out.println("Excepció: " + ex.getMessage());
        }
    }
    
    public Connection getConnexio(){
        return con;
    }
    
}
