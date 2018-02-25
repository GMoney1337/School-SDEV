import java.nio.file.Files;
import java.nio.file.Paths;
import javax.crypto.*;

public class AESEncryption {

    public static void main(String[] args) throws Exception {
        String FileName = "encryptedtext.txt";
     

        KeyGenerator KeyGen = KeyGenerator.getInstance("AES");
        KeyGen.init(256);

        SecretKey SecKey = KeyGen.generateKey();

        Cipher AesCipher = Cipher.getInstance("AES");


        byte[] byteText = "This is quite secure".getBytes();

        AesCipher.init(Cipher.ENCRYPT_MODE, SecKey);
        byte[] byteCipherText = AesCipher.doFinal(byteText);
        Files.write(Paths.get(FileName), byteCipherText);
        byte[] cipherText = Files.readAllBytes(Paths.get(FileName));

        System.out.println(byteText);
    }
 
}