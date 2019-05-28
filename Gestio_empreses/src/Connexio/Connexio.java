/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Connexio;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 * @brief Clase que facilita la connexió a la Base de dades projecte_kevin
 * @author Kevin Medina
 */
public class Connexio {
    Connection con = null;
    /**
     * Constructor de l'objecte Connexio
     */
    public Connexio() {
        try {
            String url = "jdbc:mysql://localhost:3306/projecte_kevin?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC";//?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC
            con = DriverManager.getConnection(url, "root", "");          
        } catch (SQLException ex) {
            System.out.println("Excepció: " + ex.getMessage());
        }
    }
    
    /**
     * Mètode que retorna un objecte amb la connexió establerta
     * @return l'objecte de tipus Connection
     */
    public Connection getConnexio(){
        return con;
    }
    
}
