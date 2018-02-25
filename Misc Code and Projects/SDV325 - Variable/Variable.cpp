#include <iostream>
#include <cmath>
#include <stdlib.h>
using namespace std;

int main ()
{
    string A;
    string B;
    string C;
    string D;
    
    cout << "Type in a Username:/n" << endl;
    cin >> A;
    cout << "Enter a Password:/n" << endl;
    cin >> B;
    cout << "Congratulations,  your account has been created!/n" << endl;
    system("pause");
    system("cls");
    
    cout << "=+=+=+=Account Login=+=+=+= " << endl;
    cout << "Username: /n" << endl;
    cin >> C;
    cout << "Password: /n" << endl;
    cin >> D;
    
    if (C == A || D == B)
    {
        cout << "Login successful!" << endl;
        system("pause");
        system("cls");
    }
    else
    {
        cout << "Invalid Credentials!" << endl;
        system("pause");
        return 0;
    }
    system("pause");
    return 0;
}