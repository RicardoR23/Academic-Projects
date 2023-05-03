public class Queue {

    Queue.Node head;

    class Node {

        int num;
        Node nextNode;

        Node(int num) {
            this.num = num;
            nextNode = null;
        }
    }

    public void dequeue(Queue queue) {

        if (queue.head == null) {
            System.out.println("Queue underflow");
            System.exit(0);
        }

        queue.head = queue.head.nextNode;
    }

    public void enqueue(Queue queue, int num) {

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

    public int front(Queue queue) {
        return queue.head.num;
    }

    public int size(Queue queue) {

        int size = 1;

        Node temp = queue.head;
        while (temp.nextNode != null) {
            temp = temp.nextNode;
            size++;
        }
        return size;
    }

    public boolean isEmpty(Queue queue) {

        if (queue.head == null) {
            return true;
        } else {
            return false;
        }
    }
}