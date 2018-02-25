#include <iostream>
using namespace std;

int main()
{
    int age = 0;
    bool vote = true;
    while(vote == true)
    {
        //Get age
        cout << "How old are you?" << endl;
        cin >> age;

        if (age == 18)
            cout << "Congratulations, you're old enough to vote!" << endl;
        else if (age < 18)
            cout << "Sorry, too young to vote" << endl;
        else if (age < 60)
            cout << "Don't forget to vote" << endl;
        else
            cout << "Get the vote out" << endl;
    }
        return 0;
                
}