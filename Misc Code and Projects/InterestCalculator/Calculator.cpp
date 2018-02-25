#include <iostream>
#include <iomanip>
#include <cmath>
#include <stdlib.h>
using namespace std;

int main ()
{
    cout << "This is a simple compound interest calculator and is a useful tool.\n";
            double PRINCIPAL;
            double INTEREST_RATE;
            double COMPOUND_AMOUNT;
            
            cout << "What is the balance of your savings account?\n";
            cin >> PRINCIPAL;
            
            cout << "What is the annual interest rate for your savings account?\n";
            cin >> INTEREST_RATE;
            
            cout << "How many times has the interest compounded\n;";
            cin >> COMPOUND_AMOUNT;
            
            double amt1 = 1 + (INTEREST_RATE/COMPOUND_AMOUNT);
            double AMOUNT = PRINCIPAL * pow(amt1, COMPOUND_AMOUNT);
            
            cout << "Interest Rate: " << INTEREST_RATE << endl;
            cout << "Times Compounded: " << COMPOUND_AMOUNT << endl;
            cout << "Principal: " << PRINCIPAL << endl;
            cout << "Interest: " << INTEREST_RATE * COMPOUND_AMOUNT << endl;
            cout << "Amount: " << AMOUNT  << endl;
            
            system("pause");
            return 0;
}
