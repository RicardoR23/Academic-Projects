public class LinkedList {

    Node head;

    class Node {

        int num;
        Node nextNode;

        Node(int num) {
            this.num = num;
            nextNode = null;
        }
    }

    public void addFirst(LinkedList list, int num) {

        if (list.head == null) {
            list.head = new Node(num);
        } else {
            Node new_node = list.head;
            list.head = new Node(num);
            list.head.nextNode = new_node;
        }
    }

    public void removeFirst(LinkedList list) {
        list.head.nextNode = list.head;
    }

    public void addLast(LinkedList list, int num) {

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

    public void removeLast(LinkedList list) {

        Node temp = list.head;

        while (temp.nextNode.nextNode != null) {
            temp = temp.nextNode;
        }
        temp.nextNode = null;
    }

    public int getFirst(LinkedList list) {
        return list.head.num;
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

    public static void showElements(LinkedList list, Node node) {

        if (node.nextNode == null) {
            System.out.println(node.num);
        } else {
            Node lastNode = node;
            node = node.nextNode;
            System.out.println(lastNode.num);
            showElements(list, node);
        }
    }

    public static void main(String[] args) {

        LinkedList list = new LinkedList();

        list.addLast(list, 1);
        list.addLast(list, 2);
        list.addLast(list, 3);
        list.addLast(list, 4);
        list.addLast(list, 5);
        list.addLast(list, 6);
        list.addLast(list, 7);
        list.addLast(list, 8);
        list.addLast(list, 9);
        list.addLast(list, 10);

        showElements(list, list.head);
    }
}