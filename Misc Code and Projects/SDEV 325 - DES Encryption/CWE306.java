// AUTHOR: Galen Yanofsky
// DATE: 4/23/2017
// PURPOSE: Demonstrate DES Encryption


package cwe306;

import java.util.*;
import java.lang.*;
import java.io.*;
import java.security.*;
import javax.crypto.*;
public class CWE306 {

    /**
     * @param args the command line arguments
     */


public class cwe306 {
    
    static String algorithm = "DESede";
	public static void main (String[] args) throws Exception {
	    Key symKey = Key.Generator.getInstance(algorithm).generateKey();
	    Cipher c = Cipher.getInstance(algorithm);
	    
	    byte [] encryptionBytes = encryptF("texttoencrypt",symKey,c);
	    
	    System.out.println("Decrypted: " + decryptF(encryptionBytes,symKey,c));
	   }
	   
	   private static byte[] encryptF(String input,Key pkey,Cipher c) throws InvalidKeyException, BadPaddingException,
	   
	   IllegalBlockSizeException {
	       
	       c.init(Cipher.ENCRYPT_MODE,pkey);
	       byte[] inputBytes = input.getBytes();
	       return c.doFinal(inputBytes);
	       
	   }
	   private static String decryptF(byte[] encryptionBytes,Key pkey,Cipher c)
	   throws InvalidKeyException,
	   
	   BadPaddingException, IllegalBlocksSizeException {
	       
	       c.init(Cipher.DECRYPT_MODE, pkey);
	       byte[] decrypt = c.doFinal(encryptionBytes);
	       String decrypted = new String(decrypt);
	       return decrypted;
	   }
	
	}
