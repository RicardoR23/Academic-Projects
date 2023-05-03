import java.util.Scanner;

public class BalancedParentheses {

    static class LinkedList {

        int balance = 0;

        Node head;

        class Node {

            char bracket;
            Node nextNode;

            Node(char bracket) {
                this.bracket = bracket;
                nextNode = null;
            }
        }

        public void push(LinkedList list, char bracket) {

            balance++;

            if (list.head == null) {
                list.head = new Node(bracket);
            } else {
                Node temp = list.head;
                while (temp.nextNode != null) {
                    temp = temp.nextNode;
                }
                temp.nextNode = new Node(bracket);
                temp.nextNode.nextNode = null;
            }
        }

        public void pop(LinkedList list, char bracket) {

            if (balance == 0) {
                System.out.println("The string is not balanced");
                System.exit(0);
            }

            balance--;

            switch (bracket) {

                case ')':

                    if (list.getLast(list) == '(') {
                    } else {
                        System.out.println("The string is not balanced");
                        System.exit(0);
                    }
                    break;

                case ']':

                    if (list.getLast(list) == '[') {
                    } else {
                        System.out.println("The string is not balanced");
                        System.exit(0);
                    }
                    break;

                case '}':

                    if (list.getLast(list) == '{') {
                    } else {
                        System.out.println("The string is not balanced");
                        System.exit(0);
                    }
                    break;
            }

            Node temp = list.head;

            while (temp.nextNode != null && temp.nextNode.nextNode != null) {

                temp = temp.nextNode;
            }
            temp.nextNode = null;
            return;
        }

        public int getLast(LinkedList list) {
            if (list.head.nextNode == null) {
                return list.head.bracket;
            } else {
                Node temp = list.head;
                while (temp.nextNode != null) {
                    temp = temp.nextNode;
                }
                return temp.bracket;
            }
        }

    }

    public static void main(String[] args) {

        Scanner scnr = new Scanner(System.in);
        LinkedList list = new LinkedList();

        int length;
        String input;

        System.out.println("Please enter a string");
        input = scnr.nextLine();

        length = input.length();

        for (int i = 0; i < length - 1; i++) {

            if (input.charAt(i) == '(' || input.charAt(i) == '[' || input.charAt(i) == '{') {
                list.push(list, input.charAt(i));
            } else if (input.charAt(i) == ')' || input.charAt(i) == ']' || input.charAt(i) == '}') {
                list.pop(list, input.charAt(i));
            } else if (input.charAt(i) != '0' && input.charAt(i) != '1' && input.charAt(i) != '2'
                    && input.charAt(i) != '3' && input.charAt(i) != '4' && input.charAt(i) != '5'
                    && input.charAt(i) != '6' && input.charAt(i) != '7' && input.charAt(i) != '8'
                    && input.charAt(i) != '9' && input.charAt(i) != '+' && input.charAt(i) != '-'
                    && input.charAt(i) != '*' && input.charAt(i) != '/') {
                System.out.println("Invalid Character");
                System.exit(0);
            }
        }
        if (list.balance != 1) {
            System.out.println(list.balance);
            System.out.println("The string is not balanced.");
            System.exit(0);
        }
        System.out.println("The String is balanced");

    }
}

// This program runs in O(n) time with n being the length of the string. This is
// because there are no nested loops or recursive calls. There is a single loop
// in the main part of the program that runs based on the length of the string.
// it checks for balanced parentheses by adding the opening brackets to the
// stack and popping when there is a match. On top of this there is a balnace
// integer variable which checks that the brackets are balanced.