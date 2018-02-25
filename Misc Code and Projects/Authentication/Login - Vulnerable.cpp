#include <iostream>
using namespace std;

int main ()
{
    char userName[15];
    char userPassword[15];
    int loginAttempt = 0;
    
    while (loginAttempt < 5)
    {
        cout << "Please enter your username: ";
        cin >> userName;
        cout << "Please enter your password: ";
        cin >> userPassword;
        
    }
    
    cout << "Thanks for stopping by!";
    
}