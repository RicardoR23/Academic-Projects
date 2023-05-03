// QUESTION 4
import java.util.Scanner;

public class MergeSort {

    public static class Queue {

        Queue.Node head;

        class Node {

            int num;
            Node nextNode;

            Node(int num) {
                this.num = num;
                nextNode = null;
            }
        }

        // if sequence is empty, print error message and terminate
        public void dequeue() {
            if (head == null) {
                System.out.println("Queue underflow");
                System.exit(0);
            }
        // set value of head variable to next node in queue to remove first element
            head = head.nextNode;
        }

        // if sequence is empty, create a new Node with the given value and set the head variable to point to it.
        public void enqueue(int num) {
            if (head == null) {
                head = new Node(num);
            } else {
                // set a temp variable to point to head node and taverse the queue until it reaches the last node
                Node temp = head;
                while (temp.nextNode != null) {
                    temp = temp.nextNode;
                }
                // create a new Node with given value and add it to the end of the queue by 
                // setting nextNode variable of the last node to point to it
                temp.nextNode = new Node(num);
                temp.nextNode.nextNode = null;
            }
        }

        // return first element in the queue
        public int front() {
            return head.num;
        }

        // starts at 1, checks if linked list is empty, if not, set temp to the nextNode
        // and increment size by 1, after return the size of the linked list
        public int size() {
            int size = 1;
            Node temp = head;
            while (temp.nextNode != null) {
                temp = temp.nextNode;
                size++;
            }
            return size;
        }

        // if head is null then empty, if not then it is not empty
        public boolean isEmpty() {
            if (head == null) {
                return true;
            } else {
                return false;
            }
        }
    }

    // sorting the two halves
    public static Queue sort(Queue queue1) {

        // calls its size and checks if the queue is greater then 1, if so we must perform mergeSort
        int length = queue1.size();
        if (length > 1) {

            // mid-point of the queue
            int mid = length / 2;

            // two queues holding the left and right half of the orginal queue
            Queue l = new Queue();
            Queue r = new Queue();

            // loop through first half and add each element to the l queue all while iterating and deqeueing to get to the next element
            for (int i = 0; i < mid; i++) {
                l.enqueue(queue1.front());
                queue1.dequeue();
            }

            // loop through second  half and add each element to the r queue all while iterating and deqeueing to get to the next element
            for (int i = mid; i < length; i++) {
                r.enqueue(queue1.front());
                queue1.dequeue();
            }

            // recurively call sort method to sort l and r queue
            // call helper method to merge the two sorted queues together into queue1 and return it
            sort(l);
            sort(r);
            return sort2(l, r, queue1);

        }
        return queue1;
    }

    // merging the two halves
    public static Queue sort2(Queue l, Queue r, Queue queue) {

        // queue must be empty into order to merge the two halves
        if (queue.isEmpty() == false) {
            System.out.println("ERROR: queue is not empty");
            System.exit(0);
        }

        int length1 = l.size();
        int length2 = r.size();
        int i = 0;
        int j = 0;

        // this will run as long as there are elements in both queues
        // if front element of l is smaller thn front element of r, l is enqueued into the output of the queue
        // and i and l are moved to the next position by calling dequeue
        // if front element of r is smaller than l, then r gets enqueued and j is incremented
        while (i < length1 && j < length2) {
            if (l.front() < r.front()) {
                queue.enqueue(l.front());
                l.dequeue();
                i = i + 1;
            } else {
                queue.enqueue(r.front());
                r.dequeue();
                j = j + 1;
            }
        }

        // these two while loops are for incase there are still elements left, both l and r queues could have different lengths
        while (i < length1) {
            queue.enqueue(l.front());
            l.dequeue();
            i = i + 1;
        }
        while (j < length2) {
            queue.enqueue(r.front());
            r.dequeue();
            j = j + 1;
        }
        return queue;

    }

//-----------------------------------------------------------------------------------------------------------------------   

 // QUESTION 8
    public static int[] reverseArray(int[] array, int length, int start) {

    // if length is equal to start, condition in true and reversal is complete, (only one element)
        if (length == start) {
            return array;
        }

    // set the length of the array equal to temp
        int temp = array[length];

    // set length of index to the value of the start index to swap the values
    // set start index value to original temp variable to swap the value of start with the original length index
        array[length] = array[start];
        array[start] = temp;

    // decrement the length and increment the start untill the array in reversed
        length--;
        start++;

        return reverseArray(array, length, start);
    }

//-----------------------------------------------------------------------------------------------------------------------   

// QUESTION 5
    public static void main(String[] args) {

        Queue queue = new Queue();
        Scanner scnr = new Scanner(System.in);

        System.out.println("Please enter the length of the queue");
        int length = scnr.nextInt();

        // prompt the user to enter each element to fill the length
        for (int i = 0; i < length; i++) {
            System.out.println("Enter an integer into the sequence");
            queue.enqueue(scnr.nextInt());
        }

        // call the mergeSort method and create an array called sqeuence with the length of the queue the user chose
        sort(queue);
        int[] sequence = new int[length];

        // runs length times and dequeues each integer from the queue using front. Stores each dequeued integer into the sequence array. 
        for (int i = 0; i < length; i++) {
            sequence[i] = queue.front();
            System.out.println(queue.front());
            queue.dequeue();
        }

//-----------------------------------------------------------------------------------------------------------------------   

         // prints message and calls reverseArray which reverses the sequence of the elements
        System.out.println("\nReversing the sequence\n");
        sequence = reverseArray(sequence, length - 1, 0);

        // for loop to traverse through the seqeuence and print the ith element
        // and increment i by 1 to iterate until we reach the length
        for (int i = 0; i < length; i++) {
            System.out.println(sequence[i]);
        }
    }
}

//-----------------------------------------------------------------------------------------------------------------------   

// QUESTION 6
// a) My implementation of the in place insertion sort algorithm runs in O(n^2) time. 
// This is because the insertion sort algorithm uses nested loops based on the length of the input sequence.

// b) My implementation of the quicksort algorithm runs in O(n^2) time aswell. 
// This is because the quicksort algorithm uses nested loops based on the length of the input sequence.

// c) My implemntation of merge sort has an O(nlogn) running time. 
// The n part comes from the actual comparisons being made between the split up sequences
// and the logn part comes from the recursive calls being made to split the sequence into 2 parts.

//-----------------------------------------------------------------------------------------------------------------------   

// Peusdocode: Algorithim MergeSort
// Input queue A
//length = queue.size

//if length > 1
//	mid = length/2
//	queue l, r
	
//	for i=0 to mid-1 do
//		l.enqueue(A.front)
//		A.dequeue
//	for i = mid to length-1
//		r.enqueue(A.front)
//		A.dequeue
//	MergeSort(l)
//	MergeSort(r)
//	return Merge(l, r, A)

//return A

//-----------------------------------------------------------------------------------------------------------------------   

// Peusdocode: Algorithim Merge
//Input queue l, queue r, queue A

//if A is not empty
//	return ERROR

//length1 = l.size
//length2 = r.size

//j, i = 0

//while i < length1 and j < length2
//	if l.front < r.front
//		A.enqueue(l.front)
//		l.dequeue
//		i++
//	else 	
//		A.enqueue(r.front)
//		r.dequeue
//		j++

//while i < length1 
//	queue.enqueue(l.front)
//        l.dequeue
//        i++
        
//while j < length2 
//        queue.enqueue(r.front)
//        r.dequeue
//        j++
        
//return queue;