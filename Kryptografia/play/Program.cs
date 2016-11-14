using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Spotify
{
    public class Program
    {
        static void Main(string[] args)
        {
            var start = new config.Config();
            start.Init();
            start.EncodeFiles();
            //start.DecodeFiles();
            start.SpotifyPlayer();
        }
    }
}
