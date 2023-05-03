#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int top2 = -1;

void push(char stack[], char temp);
void pop(char stack[], char temp);

int main(void) {
    char stack[1000];

    puts("Enter a string");
    scanf("%s", stack);

    int length = strlen(stack);

// for length of string
// if character in string is an opening bracket then push
// Check to see if it is an opening bracket, add it to the top
// of the stack.
    for (int i = 0; i < length; i++) {
        if (stack[i] == '(' || stack[i] == '[' || stack[i] == '{') {
            push(stack, stack[i]);

// else if character in string is an closing bracket then pop
// If it is a close bracket, then use pop to remove the previous opening bracket from
// the top of the stack and check if the two brackets match.
        } else if (stack[i] == ')' || stack[i] == ']' || stack[i] == '}') {
            pop(stack, stack[i]);

// else if character in string is not a valid character then
//      print: invalid character
//      return
        } else if (stack[i] != '0' && stack[i] != '1' && stack[i] != '2' && stack[i] != '3' && stack[i] != '4' && stack[i] != '5' && stack[i] != '6' && stack[i] != '7' && stack[i] != '8' && stack[i] != '9' && stack[i] != '+' && stack[i] != '-' && stack[i] != '*' && stack[i] != '/') {
            puts("Invalid character");
            return 0;
        }
    }

// if stack is not empty then
//      print: The String is not balanced
//      return
    if (top2 != -1) {
        puts("The String is not balanced.");
        return 0;
    }

// print: This String is balanced
    puts("This String is balanced.");
}

// push
//     if stack is full then
//         print: The stack is full
//         exit
void push(char stack[], char temp) {
    if (top2 > 999) {
        puts("The stack is full");
        exit(0);
    } else {
        top2++;
        stack[top2] = temp;
    }
}

// pop
// if stack is empty then
//         print: The String is not balanced
//         return
void pop(char stack[], char temp) {
    if (top2 == -1) {
        puts("The String is not balanced");
        return;
    }
// switch (check if brackets match)
//         if brackets match
//             remove character from stack
//             return
    switch (temp) {
        case ')':
            if (stack[top2] == '(') {
                top2--;
                return;
            }
            break;

        case ']':
            if (stack[top2] == '[') {
                top2--;
                return;
            }
            break;

        case '}':
            if (stack[top2] == '{') {
                top2--;
                return;
            }
            break;

// else
//          print: The String is not balanced
//          exit
        default:
            puts("The String is not balanced");
            exit(0);
            break;
    }
}

//  c) This program runs in O(n) time with n being the length of the string. 
//     This is because there are no nested loops in the program and the one loop is always running the length of the string.

// Pseudo code:
// for length of string
//     if character in string is an opening bracket then
//         push
//     else if character in string is an closing bracket then
//         pop
//     else if character in string is not a valid character then
//         print: invalid character
//         return

// if stack is not empty then
//     print: The String is not balanced
//     return

// print: This String is balanced

// push
//     if stack is full then
//         print: The stack is full
//         exit
//     else
//         add character to stack

// pop
//     if stack is empty then
//         print: The String is not balanced
//         return

//     switch (check if brackets match)
//         if brackets match
//             remove character from stack
//             return
//         else
//             print: The String is not balanced
//             exit