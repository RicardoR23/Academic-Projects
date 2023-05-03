import java.util.Scanner;

public class Merge {

    static class queue {

        Node head;

        class Node {

            int num;
            Node nextNode;

            Node(int num) {
                this.num = num;
                nextNode = null;
            }
        }

        public void dequeue(queue queue) {

            if (queue.head == null) {
                System.out.println("Queue underflow");
                System.exit(0);
            }

            queue.head = queue.head.nextNode;
        }

        public void enqueue(queue queue, int num) {

            if (queue.head == null) {
                queue.head = new Node(num);
            } else {
                Node temp = queue.head;
                while (temp.nextNode != null) {
                    temp = temp.nextNode;
                }
                temp.nextNode = new Node(num);
                temp.nextNode.nextNode = null;
            }
        }

        public int front(queue queue) {
            return queue.head.num;
        }

        public int size(queue queue) {

            int size = 1;

            Node temp = queue.head;
            while (temp.nextNode != null) {
                temp = temp.nextNode;
                size++;
            }
            return size;
        }

        public boolean isEmpty(queue queue) {

            if (queue.head == null) {
                return true;
            } else {
                return false;
            }
        }

        public static void showElements(queue list, Node node) {

            if (node.nextNode == null) {
                System.out.println(node.num);
            } else {
                Node lastNode = node;
                node = node.nextNode;
                System.out.println(lastNode.num);
                showElements(list, node);
            }
        }

    }

    public static void main(String args[]) {

        Scanner scnr = new Scanner(System.in);

        queue A = new queue();
        queue B = new queue();
        queue C = new queue();

        boolean exit = false;
        int num, length1, length2, choice;

        while (exit == false) {
            System.out.println("Pick one of the following options:");
            System.out.println("1. Enter an integer into queue A");
            System.out.println("2. Enter an integer into queue B");
            System.out.println("3. Get output");
            choice = scnr.nextInt();

            switch (choice) {
                case 1:
                    System.out.println("Enter an integer to put into queue A:");
                    num = scnr.nextInt();
                    A.enqueue(A, num);
                    break;

                case 2:
                    System.out.println("Enter an integer to put into queue B:");
                    num = scnr.nextInt();
                    B.enqueue(B, num);
                    break;

                case 3:

                    length1 = A.size(A);
                    length2 = B.size(B);

                    int i = 0;
                    int j = 0;

                    while (i < length1 && j < length2) {

                        if (A.front(A) < B.front(B)) {
                            C.enqueue(C, A.front(A));
                            i++;
                            A.dequeue(A);
                        } else {
                            C.enqueue(C, B.front(B));
                            j++;
                            B.dequeue(B);
                        }
                    }
                    while (i < length1) {
                        C.enqueue(C, A.front(A));
                        i++;
                        A.dequeue(A);
                    }
                    while (j < length2) {
                        C.enqueue(C, B.front(B));
                        j++;
                        B.dequeue(B);
                    }

                    C.showElements(C, C.head);
            }

            // if (length1 >= length2) {
            // while (temp2.nextNode != null) {
            // if (temp.num > temp2.num) {
            // C.enqueue(C, temp2.num);
            // temp2 = temp.nextNode;
            // } else {
            // C.enqueue(C, temp.num);
            // temp = temp.nextNode;
            // }
            // }
            // while (temp.nextNode != null) {
            // C.enqueue(C, temp.num);
            // }
            // C.enqueue(C, temp.num);
            // } else {
            // while (temp.nextNode != null) {
            // if (temp.num > temp2.num) {
            // C.enqueue(C, temp2.num);
            // temp2 = temp.nextNode;
            // } else {
            // C.enqueue(C, temp.num);
            // temp = temp.nextNode;
            // }
            // }
            // while (temp2.nextNode != null) {
            // C.enqueue(C, temp2.num);
            // }
            // C.enqueue(C, temp2.num);
            // }

            // Merge.queue.Node temp3 = C.head;

            // while (temp3.nextNode != null) {
            // System.out.println(temp3.num);
            // }
            // }
        }
    }
}