package http_server;

/**
* author: Mahmoud abdelsalam abdelkader
* Academic id: 20151403181
* Project title: simple HTTP web server that handles get & post request with multi client
* Course Code: C304
* for example enter in url www.localhost.com/sro/
* if you compiled the program as an executable jar file, but the directory of HTML in same folder of jar.
*/

import java.net.ServerSocket;
import java.net.Socket;

public class HTTP_SERVER {

    public static void main(String[] args) {
        try {
            ServerSocket SERVER = new ServerSocket(80);  //listening on port 80
            System.out.println("Waiting for clients...");

            while (true) {
                Socket SOCK = SERVER.accept();   //when server socket capture new client;
                System.out.println("A new client is trying to connect : " + SOCK.getInetAddress()+" on remote port : "+SOCK.getPort());
                Http_ClientHandler client = new Http_ClientHandler(SOCK);  //http request handler
                Thread New = new Thread((Runnable) client);  //Multi threading clients.
                New.start();
            }
        } catch (Exception e) {
            System.out.println(Http_ClientHandler.class.getName() + " : " + e);
        }
    }
}
