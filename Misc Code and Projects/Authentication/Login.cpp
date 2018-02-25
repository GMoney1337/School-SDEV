#include <iostream>
using namespace std;

int main ()
{
    string userName;
    string userPassword;
    int loginAttempt = 0;
    
    while (loginAttempt < 5)
    {
        cout << "Please enter your username: ";
        cin >> userName;
        cout << "Please enter your password: ";
        cin >> userPassword;
        
        if (userName == "Galen" && userPassword == "Bobo")
        {
            cout << "Login success! Welcome, Galen " << endl;
            break;
        }
        if (userName == "Charlie" && userPassword == "Chuck")
        {
            cout << "Login success! Welcome Big Chuck" << endl;
            break;
        }
        else if (userName == "Alfredo" && userPassword == "Cheese")
        {
            cout << "Hello Alfredo!";
            break;
        }
        else
        {
            cout << "Invalid login attempt. Please try again." << endl;
            loginAttempt ++;
            
        }
    }
    if (loginAttempt == 5)
    {
        cout << "Too many login attempts. The program will terminate. Hasta la vista, Baby!" << endl;
        return 0;
    }
}
  