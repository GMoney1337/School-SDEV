#include <iostream>
/*
 Author: Galen Yanofsky
 Course: SDEV 325: Detecting Software Vulnerabilities
 Assignment 2: CWE-120
 */

int main(int argc, char *argv[]){
    if(argc < 2){
        cout << "You must supply a value\n";
        exit(0);
    }
    char buffer[10];
    strcopy(buffer, argv[1]);
    cout <<"The value you supplied is";
    cout << buffer
    cout ("\n");
    
    return 0;
}