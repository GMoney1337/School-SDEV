#include <iostream>
#include <stdlib.h>
using namespace std;

int main()
{
string userName;
string userPassword;
bool login = true;
     while(login == true)
     {
        cout << "Please enter your username: " << endl;
        cin >> userName;
        cout << "Please enter your password: " << endl;
        cin >> userPassword;
    
        if (userName == "Galen" && userPassword == "Gmoney")
        {
            cout << "Login success! Welcome, Galen" << endl;
            login = false;
        }
        else if (userName == "Charlie" && userPassword == "Chuck")
        {
            cout << "Login success! Welcome Big Chuck" << endl;
            login = false;
        }
        else if (userName == "Admin" && userPassword == "Password")
        {
            cout << "Login success! Welcome Administrator";
            login = false;
        }
        else
            cout << "Invalid login attempt. Please try again. \n" << endl;
     }
       
}
 