using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Security.Cryptography;
using System.Text;
using System.Threading;
using System.Threading.Tasks;


namespace Spotify.config
{
    public class Config
    {
        string passfile = "files//password.ils";
        string pass;
        byte[] key = crypto.CryptoAddons.GetByteArrayFromStringHex("b14f636c88ba3dad57d53a8fab09dd95512ce1b545bbb93362113487e73a13fe");
        byte[] iv = crypto.CryptoAddons.GetByteArrayFromStringHex("d9fe9356611591730627a97ea4107f85");
        int nKeys;
        List<Key.KeyIv> KeyIvList;
        
        public void Init()
        {

            crypto.Crypto.EncryptFile("files\\keys", key, iv, CipherMode.CBC); 
            if (File.Exists(passfile))    //Already has pass fie
            {
                pass = crypto.Crypto.GetDecryptStreamReader(passfile, key, iv, System.Security.Cryptography.CipherMode.CBC).ReadLine();
                while (!CheckPassword()) ;
            }
            else                         //Create new pass file
            {
                Console.WriteLine("Create password:");
                pass = GetPassword();
                crypto.Crypto.EncryptToFile(passfile,pass, key, iv, System.Security.Cryptography.CipherMode.CBC);
            }
            do
            {
                string keystore = GetCorrectLocalization("Enter keystore localization:");
                KeyIvList = Key.KeyStore.GetKeyIvList(crypto.Crypto.GetDecryptStreamReader(keystore, key, iv, System.Security.Cryptography.CipherMode.CBC));
                nKeys = KeyIvList.Count;
            } while (nKeys == 0);
        }
        public void SpotifyPlayer()
        {
            Console.WriteLine("\n<< MP3 Player >>");
            int nkey = GetNumberOfKey();
            CipherMode mode = GetCipherMode();
            string filetodecode = GetMusicLocalization("Enter song title:");
            var stream = crypto.Crypto.GetDecryptMemoryStream(filetodecode, KeyIvList[nkey].Key, KeyIvList[nkey].Iv, mode);
            Thread play = new Thread(()=>Player.Player.PlayMp3FromUrl(stream));
            play.Start();
            Console.ReadLine();
            Player.Player.br = true;
        }
        public void EncodeFiles()
        {
            Console.WriteLine("\nEncodeing by AES");
            int nkey = GetNumberOfKey();
            CipherMode mode = GetCipherMode();
            string filetoencode = GetCorrectLocalization("Enter file localization:");
            crypto.Crypto.EncryptFile(filetoencode,KeyIvList[nkey].Key, KeyIvList[nkey].Iv, mode);
            Console.WriteLine("File encoded using AES algorithm " + filetoencode);
        }
        public void DecodeFiles()
        {
            Console.WriteLine("\nDecoding by AES");
            int nkey = GetNumberOfKey();
            CipherMode mode = GetCipherMode();
            string filetodecode = GetCorrectLocalization("Enter file localization to decode");
            crypto.Crypto.DecryptFile(filetodecode, KeyIvList[nkey].Key, KeyIvList[nkey].Iv, mode);
            Console.WriteLine("File decoded using AES algorithm " + filetodecode);
        }
        public int GetNumberOfKey()
        {
            Console.WriteLine("Choose key:\n(" + nKeys + " keys availible)\n");
            int n = GetNumber()-1;
            return n;
        }
        public int GetNumber()
        {
            int n;
            while (true)
            {
                try
                {
                    n = int.Parse(Console.ReadLine());
                    break;
                }
                catch (Exception) { }
            }
            return n;
        }
        public bool CheckPassword()
        {
            Console.WriteLine("Enter your password:");
            string x = GetPassword();
            return x.Equals(pass);
        }
        public string GetCorrectLocalization(string info)
        {
            string dir;
            do
            {
                Console.WriteLine(info);
                dir = Directory.GetCurrentDirectory() + "\\" + Console.ReadLine();
                Console.WriteLine(dir);
            }
            while (!File.Exists(dir));
            return dir;
        }

        public string GetMusicLocalization(string info)
        {
            string url;
            do
            {
                Console.WriteLine(info);
                url = Directory.GetCurrentDirectory() + "\\music\\" + Console.ReadLine() + ".mp3.ils";
                Console.WriteLine(url);
            }
            while (!File.Exists(url));
            return url;
        }

        public CipherMode GetCipherMode()
        {
                    return CipherMode.CBC;
                    //return CipherMode.CFB;                
                    //return CipherMode.CTS;            
                    //return CipherMode.ECB;
                    //return CipherMode.OFB;
        }
        public string GetPassword()
        {
            string password = "";
            ConsoleKeyInfo key;
            do
            {
                key = Console.ReadKey(true);
                if (key.Key != ConsoleKey.Backspace && key.Key != ConsoleKey.Enter)
                {
                    password += key.KeyChar;
                    Console.Write("|");
                }
                else
                {
                    Console.Write("\b");
                }
            }
            while (key.Key != ConsoleKey.Enter);
            Console.WriteLine();
            return password;
        }
    }
}
