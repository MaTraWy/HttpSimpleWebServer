package http_server;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.Socket;

public class Http_ClientHandler implements Runnable {

    private final Socket Http;
    private final BufferedReader Read;
    private final OutputStream Write;
    final static String LineEnd = "\r\n"; // carriage return (CR) and a line feed (LF) used to determine the end of line.
    String Status = "";  //status line
    String ContentType = "";  //content type line
    String Body = "";  //body line 

    public Http_ClientHandler(Socket Http) throws Exception {
        System.out.println("Client " + Http.getInetAddress() + " On remote port " + Http.getPort() + " Connected");
        this.Http = Http;
        Read = new BufferedReader(new InputStreamReader(Http.getInputStream()));
        Write = Http.getOutputStream();
    }

    @Override
    public void run() {
        try {
            String Request = Read.readLine();  //read the firstline "request line".
            System.out.println("Client " + Http.getInetAddress() + " On remote port " + Http.getPort() + " Request line : " + Request);

            String Tockens[];
            Tockens = Request.split(" ");     // breaking request line into array of string.
            if (Tockens[0].equals("GET")) {   // handle Get request.
                String filename;
                
                if (Tockens[1].endsWith("/")) {
                    filename = "." + Tockens[1] + "index.html";
                } else {
                    filename = "." + Tockens[1];
                }
                try {
                    FileInputStream input;
                    input = new FileInputStream(filename);
                    System.out.println("Client " + Http.getInetAddress() + " On remote port " + Http.getPort() + " Requested File :" + filename + " Found");
                    GetResponse(input, filename);

                } catch (FileNotFoundException e) {

                    FileNotFoundError();    //file not found error.
                    System.out.println("Client " + Http.getInetAddress() + " On remote port " + Http.getPort() + " Requested File :" + filename + " Not Found");
                }
            } else if (Tockens[0].equalsIgnoreCase("POST")) {   //handling post request.
                PostResponse();
            } else {
                NotImplemntedError(); //error not implemented method.
                System.out.println("Client " + Http.getInetAddress() + " On remote port " + Http.getPort() + " Requested A Not Implemented Method");

            }
        } catch (Exception e) {
            System.out.println("catch " + this.getClass().getName() + " : " + e);
        } finally {
            try {
                Read.close();
                Write.flush();
                Http.close();
                System.out.println("Client " + Http.getInetAddress() + " On remote port " + Http.getPort() + " Disconnected");
            } catch (IOException e) {
                System.out.println("Finnally " + this.getClass().getName() + " : " + e);
            }
        }
    }

    /**
     * this function handles the get response
     *
     * @param input the file input stream instance
     * @param filename the name of file.
     */
    private void GetResponse(FileInputStream input, String filename) throws Exception {
        int bytes;
        Status = "HTTP/1.0 200 OK" + LineEnd;
        ContentType = "Content-type: " + contentType(filename) + LineEnd + LineEnd;
        Write.write(Status.getBytes());
        Write.write(ContentType.getBytes());
        BufferedInputStream m = new BufferedInputStream(input);
        byte[] barray = new byte[1024];
        while ((bytes = m.read(barray)) != -1) {
            Write.write(barray, 0, bytes);
        }
        //i used BufferedInputStream  becouse of the builtin byte array buffer, which helps in accelerate sending data process.
    }

    /**
     * this function handles the PostResponse.
     */
    private void PostResponse() throws Exception {
        String[] values;
        int count = 0;
        StringBuilder inputline = new StringBuilder(); //i used "String builder" instead of "String" becouse its faster in concatenation process.
        while (!(Read.readLine().equals(""))); //untill we go to last line(param line).
        while (Read.ready()) {
            inputline.append((char) Read.read());  //concatenate param line.
        }
        values = (inputline.toString()).split("&"); //spliting inputs
        Status = "HTTP/1.0 200 OK" + LineEnd;
        ContentType = "Content-type: " + contentType("hhhh.html") + LineEnd + LineEnd;
        Body = "<HTML>"
                + "<HEAD><TITLE>Values Submited</TITLE></HEAD>"
                + "<BODY>";
        for (String in : values) {
            if (count >= values.length - 1) {
                break;
            }
            Body += "<h4>" + in + "</h4><br>";  //adding the input to html file.
            count++;
        }
        Body += "</BODY>";
        print();
    }

    /**
     * this function handles Not implement response 501.
     */
    private void NotImplemntedError() throws Exception {
        Status = "HTTP/1.0 501 Not Implemented" + LineEnd;
        ContentType = "Content-type: " + "text/html" + LineEnd + LineEnd;
        Body = "<HTML>"
                + "<HEAD><TITLE>Not Implemented</TITLE></HEAD>"
                + "<BODY>Not Implemented</BODY></HTML>";
        print();
    }

    /**
     * this function handles File Not found response 401.
     */
    private void FileNotFoundError() throws Exception {
        Status = "HTTP/1.0 401 Not Found" + LineEnd;
        ContentType = "Content-type: " + "text/html;" + LineEnd + LineEnd;//content info
        Body = "<HTML>"
                + "<HEAD><TITLE>Not Found</TITLE></HEAD>"
                + "<BODY>Not Found</BODY></HTML>";
        print();

    }

    /**
     * this function return the type of file to add it to the content type line.
     *
     * @param fileName the name of file.
     */
    static String contentType(String fileName) {
        if (fileName.endsWith(".htm") || fileName.endsWith(".html")) {
            return "text/html";
        }

        if (fileName.endsWith(".xml")) {
            return "text/xml";
        }

        if (fileName.endsWith(".plain")) {
            return "text/plain";
        }

        if (fileName.endsWith(".css")) {
            return "text/css";
        }

        if (fileName.endsWith(".jpg") || fileName.endsWith(".jpeg")) {
            return "image/jpeg";
        }

        if (fileName.endsWith(".gif")) {
            return "image/gif";
        }

        if (fileName.endsWith(".png")) {
            return "image/png";
        }

        return "application/octet-stream";
    }

    /**
     * function to print error response.
     */
    private void print() throws Exception {
        Write.write(Status.getBytes());
        Write.write(ContentType.getBytes());
        Write.write(Body.getBytes());
    }
}
