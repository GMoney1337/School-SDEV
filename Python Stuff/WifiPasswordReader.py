import sys, os

"""
PURPOSE:
The following script can be used to view the plaintext saved password on a
    Windows OS. The syntax: 'python WifiPasswordReader.py "SSID"' must be
    entered. Only works on already authenticated Wifi networks. """

var = sys.argv[1]
os.system('netsh wlan show profile name="'+var+'" key=clear')
