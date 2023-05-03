#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int top2 = -1;

void push(char stack[]);
void pop(char stack[], char temp);

int main(void) {
    char stack[1000];

    puts("Enter a string");
    scanf("%s", stack);

    int length = strlen(stack);

// if first character = 1
//     print: no
//     exit
    if (stack[0] == '1') {
        puts("No");
        exit(0);
    }

// for length of string
//     if character is zero
//         push
    for (int i = 0; i < length; i++) {
        if (stack[i] == '0') {
            push(stack);
        } else {
//        else
//         for remainder of string
//             if character is zero
//                 print: no
//                 exit
//          pop
            for (int n = i + 1; n < length; n++) {
                if (stack[n] == '0') {
                    puts("No");
                    exit(0);
                }
            }
            pop(stack, stack[i]);
        }
    }
// if stack is not empty
//     print: no
//     exit
    if (top2 != -1) {
        puts("No");
        exit(0);
    }
// print: yes
    puts("Yes");
}

// push the 0's to the top of the stack...
//     if stack is full
//         print: the stack is full
//         exit
//     else
//         add character to stack
void push(char stack[]) {
    if (top2 > 999) {
        puts("The stack is full");
        exit(0);
    } else {

        
        top2++;
        stack[top2] = '0';
    }
}

// pop, checking to see how many 1's there are...
//     if stack is empty
//         print: no
//         exit
//     else
//         remove character from stack
void pop(char stack[], char temp) {
    if (top2 == -1) {
        puts("No");
        exit(0);
    } else {
        top2--;
    }
}

//  c) The worst case running time will be O(n^2) where N is the length of the string. 
// This is because there is a nested loop to check that after 1 is read that there are no more zeros in the string. 
// This checks the condition of something such as 1010 which would normally read yes even though the output should be no.

// Pseudo code:
// if first character = 1
//     print: no
//     exit

// for length of string
//     if character is zero
//         push
//     else
//         for remainder of string
//             if character is zero
//                 print: no
//                 exit
//         pop

// if stack is not empty
//     print: no
//     exit

// print: yes

// push
//     if stack is full
//         print: the stack is full
//         exit
//     else
//         add character to stack

// pop
//     if stack is empty
//         print: no
//         exit
//     else
//         remove character from stack