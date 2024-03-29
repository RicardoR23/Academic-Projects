#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int top2 = -1;

void push(int stack[]);
void pop(int stack[]);
void top1(int stack[]);
void size(int stack[]);
void isEmpty(int stack[]);

int main(void) {
    int stack[1000];
    int choice = 0;

    while (choice != 6) {
        puts("\nPlease select one of the following operations:");
        puts("1: push: push to the top of the stack");
        puts("2: pop: pop from the top of the stack");
        puts("3: top: top of the stack");
        puts("4: size: size of the stack");
        puts("5: isEmpty: is the stack empty");
        puts("6: Exit the program");
        scanf("%d", &choice);

        switch (choice) {
            case 1:
                push(stack);
                break;

            case 2:
                pop(stack);
                break;

            case 3:
                top1(stack);
                break;

            case 4:
                size(stack);
                break;

            case 5:
                isEmpty(stack);
                break;

            case 6:
                return 0;

            default:
                printf("Unknown operation");
        }
    }
}

// The integer entered by the user is stored in a variable called "temp". 
// The variable "top2" is then incremented by 1 and 
// the value of "temp" is assigned to the element in the stack at the current top2 index. 
void push(int stack[]) {
    int temp;

    if (top2 > 999) {
        puts("The stack is full");
    } else {
        puts("Enter a integer to be pushed");
        scanf("%d", &temp);
        top2++;
        stack[top2] = temp;
    }
}

// In the pop function, check if the stack is empty and if so, display a message saying so. 
// If not, display the element at the top of the stack and 
// update the "top2" variable to reflect the new top of the stack
void pop(int stack[]) {
    if (top2 < 0) {
        printf("\n Stack is empty");
    } else {
// Last in First Out, remove top element from Stack
        printf("\n The pushed integer is %d", stack[top2]);
        top2--;
    }
}
void top1(int stack[]) {
    printf("\nThe integer at the top of the stack is %d", stack[top2]);
}
void size(int stack[]) {
    printf("\nThe size of the stack is %d integers", top2 + 1);
}
void isEmpty(int stack[]) {
    if (top2 == -1) {
        printf("\n The stack is empty");
    } else {
        printf("The stack has %d integers in it", top2);
    }
}