import java.util.Scanner;

public class HeapSort {
    public static class Heap {

        int[] sequence = new int[100];
        int size = 1;

        Heap() {
        }

        public void insert(int num) {
            int place = size;
            int temp;
            sequence[size] = num;

            // ensures that the loop only runs for the elements of the heap that are not the root
            while (place > 1) {
                // checks if parent of current element is greater than current element.
                // If parents is greater, then switch
                if (sequence[place / 2] > sequence[place]) {
                    // value of current element is stored in temp, value of parents is moved down to the current element's position,
                    // and the current element's value is moved up to the parent's position
                    temp = sequence[place];
                    sequence[place] = sequence[place / 2];
                    sequence[place / 2] = temp;
                }
                // updates place to be the index of the new parent element
                place = place / 2;
            }
            // increment to show the addition of the new element
            size++;
        }

        public int removeMin() {
            // get smallest element in heap and remove it, decrement the size
            int num = sequence[1];
            int temp;
            size--;

            // move last element to the root position which was where the smallest element was. This removes that element.
            sequence[1] = sequence[size];

            int place = size;
            // Continue until we reach the end of the heap.
            while (place > 1) {

                // check if parent of current node at index place is greater than current node. If it is then swap since heap property is violated.
                if (sequence[place / 2] > sequence[place]) {

                    // store current node in temp variable, replace the value of current node with the value of parent and
                    // replace value of parent with value of the original current node (temp).
                    temp = sequence[place];
                    sequence[place] = sequence[place / 2];
                    sequence[place / 2] = temp;
                }
                
                // continue sinking the element down the heap until it reaches the proper position.
                place = place / 2;
            }
            // return smallest element that was removed from heap
            return num;
        }

// Best Case: (O(n(logn) where array is already sorted 
// Worst Case: (O(n(logn)) where input is in reverse order. O(logn) operations for n elements. 
        public int[] heapSort(Heap heap) {

            // create array with size of 100, get length of array
            int[] sortedArray = new int[100];
            int length = heap.size;

            // loop through heap from index 0 to index length -1
            // removes smallest value from heap and stores it in sortedArray, keeps looping until all values are extracted.
            for (int i = 0; i < length; i++) {
                sortedArray[i] = heap.removeMin();
            }

            return sortedArray;

        }
    }

    public static void main(String[] args) {

        Scanner scnr = new Scanner(System.in);
        Heap heap = new Heap();
        int[] sequence = new int[100];

        // prompt user to enter sequence and store it.
        System.out.println("Please enter the size of the sequence(Max is 99)");

        int size = scnr.nextInt();

        // loop through until user enters enough elements to satisfy the length
        for (int i = 0; i < size; i++) {
            System.out.println("Enter an integer into the sequence");
            sequence[i] = scnr.nextInt();
            heap.insert(sequence[i]);
        }
        // call method
        sequence = heap.heapSort(heap);
        // loop through the sequence and print each sorted element
        for (int i = 0; i < size; i++) {
            System.out.println(sequence[i]);
        }
    }
}