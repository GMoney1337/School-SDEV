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
        
        if (userName == "Galen" && userPassword == "1490")
        {
            cout << "Welcome Galen!\n";
            break;
        }
        if (userName == "Heather" && userPassword == "0362")
        {
            cout << "Welcome Heather!";
            break;
        }
        else if (userName == "Peter" && userPassword == "1749")
        {
            cout << "Howdy Peter!";
        }
        else
        {
            cout << "Invalid login attempt. Please try again.\n" << '\n';
            loginAttempt++;
        }
}
    if (loginAttempt == 5)
    {
        cout << "Too many login attempts! This program will now terminate.";
        return 0;
    }
    
}