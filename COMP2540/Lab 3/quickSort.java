// QUESTION 3
import java.util.Scanner;

public class quickSort {

    public static int[] sort(int[] sequence, int a, int b) {

        // if start index(a) is greater than or equal to end index(b), then subarray is sorted so return it
        if (a >= b) {
            return sequence;
        }

        // select last element fo the subarray (sequence[b]) as pivot element.
        // variable l is left end of the subarray and variable r is right end of the subarray
        int p = sequence[b];
        int l = a;
        int r = b - 1;
        int temp;

        // loop for as long as l is less than or equal to r. The loop rearranges the elements
        // so that elements less than pivot come before it and elements greater come after it
        while (l <= r) {
            // search for element in subarray greater than pivot. Once found, exit loop and l is incremented to next element in subarray.
            while (l <= r && sequence[l] <= p) {

                l = l + 1;
            }

            // search for element in subarray less than pivot. Once found, exit loop and r is decremented to next element in subarray.
            while (l <= r && sequence[r] >= p) {
                r = r - 1;
            }

            // if l is less than r here, than element on the left side is greater than pivot and right side is smaller
            // therefore, we need to swap the elements.
            if (l < r) {
                temp = sequence[l];
                sequence[l] = sequence[r];
                sequence[r] = temp;

            }
        }
        temp = sequence[l];
        sequence[l] = sequence[b];
        sequence[b] = temp;

        // call method recursively twice, once to sort subarray to the left of pivot and once from right
        sort(sequence, a, l - 1);
        sort(sequence, l + 1, b);
        return sequence;
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

    public static void main(String[] args) {

        // read user input and proper the user to enter the length of the sequence
        Scanner scnr = new Scanner(System.in);
        System.out.println("Please enter the size of the sequence");
        int length = scnr.nextInt();

        int[] sequence = new int[length];

        // for each iteration, the user must input an integer, assigns it to the 
        // ith index to store it and then increment i by 1 until we reach the length
        for (int i = 0; i < length; i++) {
            System.out.println("Enter an integer into the sequence");
            sequence[i] = scnr.nextInt();
        }

        // calls quickSort to sort the sequence in ascending order
        sort(sequence, 0, length - 1);
        
        // enters loop to print sequence in ascending order, prints ith element of the sequence
        // and i is incremented by 1 until it reaches the length
        for (int i = 0; i < length; i++) {
            System.out.println(sequence[i]);
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