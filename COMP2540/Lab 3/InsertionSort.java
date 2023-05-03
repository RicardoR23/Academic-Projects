// QUESTION 1: Peusdocode
// Input sequence a, sequence length

// Integer length = length of the sequence
// Integer temp
// Inetger j

// for i = 1 to length - 1
//    temp = a(i)
//    j =  i - 1

//    while j >= 0 and a[j] > temp    
//       sequence[j + 1] = sequence[j]
//        j = j - 1;
    
//    sequence[j + 1] = temp;
// Output sequence

//-----------------------------------------------------------------------------------------------------------------------

// QUESTION 2:
import java.util.Scanner;
public class InsertionSort {

    public static int[] sort(int[] sequence, int length) {
        int j, temp;

    // itereates through the array starting with the second element, first element is already sorted
    // sets current element to temp and previous element to "j" so we can compare them later   
        for (int i = 1; i < length; i++) {
            temp = sequence[i];
            j = i - 1;
    // compare elements of the temp variable to the previous element
    // if element if greater than temp varaible, previous element if shifted to the right or in front
            while (j >= 0 && sequence[j] > temp) {
                sequence[j + 1] = sequence[j];
                j = j - 1;
            }
            sequence[j + 1] = temp;
        }
    // once the for loop is complete, return the sorted sequence
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
        System.out.println("Please enter the length of the sequence");
        int length = scnr.nextInt();

        int[] sequence = new int[length];

        // for each iteration, the user must input an integer, assigns it to the 
        // ith index to store it and then increment i by 1 until we reach the length
        for (int i = 0; i < length; i++) {
            System.out.println("Enter an integer into the sequence");
            sequence[i] = scnr.nextInt();
        }

        // calls InserstionSort to sort the sequence in ascending order
        sequence = sort(sequence, length);

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