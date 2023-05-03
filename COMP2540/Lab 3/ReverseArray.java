// QUESTION 8
public class ReverseArray {

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
}

// InsertionSort:
// Best Case (O(n)), Worst Case (O(n^2)), Average (O(n^2))

// QuickSort: Faster then MergeSort
// Best Case (O(n log n), Worst Case (O(n^2)) - pivot is a min or max, Average (O(n log n))

// MergeSort:
// All Cases (O(n log n)
// (log n) for dividing and (O(n)) for merging