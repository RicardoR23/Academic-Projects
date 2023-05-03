public class StackLinkedList {

    class LinkedList {

        Node head;

        class Node {

            int num;
            Node nextNode;

            Node(int num) {
                this.num = num;
                nextNode = null;
            }
        }

        public void push(LinkedList list, int num) {

            if (list.head == null) {
                list.head = new Node(num);
            } else {
                Node temp = list.head;
                while (temp.nextNode != null) {
                    temp = temp.nextNode;
                }
                temp.nextNode = new Node(num);
                temp.nextNode.nextNode = null;
            }
        }

        public void pop(LinkedList list) {

            Node temp = list.head;

            while (temp.nextNode.nextNode != null) {
                temp = temp.nextNode;
            }
            temp.nextNode = null;
        }

        public int getLast(LinkedList list) {
            if (list.head.nextNode == null) {
                return list.head.num;
            } else {
                Node temp = list.head;
                while (temp.nextNode != null) {
                    temp = temp.nextNode;
                }
                return temp.num;
            }
        }

        public int size(LinkedList list) {

            int count = 0;

            Node temp = list.head;
            while (temp != null) {
                temp = temp.nextNode;
                count++;
            }
            return count;

        }

        public boolean isEmpty(LinkedList list) {
            if (list.head == null) {

                return true;
            }

            return false;
        }
    }
}