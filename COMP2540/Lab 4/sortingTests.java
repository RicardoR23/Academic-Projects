import java.util.Random;

public class sortingTests {

    public static void mergeSort(int[] a, int n) {
        // checks if there is more than one element
        if (n < 2) {
            return;
        }
        int mid = n / 2;
        int[] l = new int[mid];
        int[] r = new int[n - mid];

        for (int i = 0; i < mid; i++) {
            l[i] = a[i];
        }
        for (int i = mid; i < n; i++) {
            r[i - mid] = a[i];
        }
        mergeSort(l, mid);
        mergeSort(r, n - mid);

        merge(a, l, r, mid, n - mid);
    }

    public static void merge(int[] a, int[] l, int[] r, int left, int right) {
        // merge both l and r into the original array called a.
        int i = 0, j = 0, k = 0;
        while (i < left && j < right) {
            if (l[i] <= r[j]) {
                a[k++] = l[i++];
            } else {
                a[k++] = r[j++];
            }
        }
        // if there are still any elements left, loop copies then into the merged array called a.
        while (i < left) {
            a[k++] = l[i++];
        }
        while (j < right) {
            a[k++] = r[j++];
        }
    }

    public static int[] insertionSort(int[] sequence, int length) {

        int j, temp;

        for (int i = 1; i < length; i++) {
            temp = sequence[i];
            j = i - 1;

            // compares current element with each element in sort subarray to its left, (less then i)
            while (j >= 0 && sequence[j] > temp) {
                sequence[j + 1] = sequence[j];
                j = j - 1;
            }
            // if current is smaller then element in sorted subarray, the element in sorted subarray is shifted one position ot the right and j is decremented.
            sequence[j + 1] = temp;
        }
        return sequence;

    }

    public static int[] quickSort(int[] sequence, int a, int b) {
// quicksort with pivot element and sorted the array into left and right then merging it back together.
        if (a >= b) {
            return sequence;
        }
        int p = sequence[b];
        int l = a;
        int r = b - 1;
        int temp;

        while (l <= r) {
            while (l <= r && sequence[l] <= p) {

                l = l + 1;
            }
            while (l <= r && sequence[r] >= p) {
                r = r - 1;
            }
            if (l < r) {
                temp = sequence[l];
                sequence[l] = sequence[r];
                sequence[r] = temp;

            }
        }
        temp = sequence[l];
        sequence[l] = sequence[b];
        sequence[b] = temp;
        quickSort(sequence, a, l - 1);
        quickSort(sequence, l + 1, b);
        return sequence;
    }

    public static class Heap {

        int[] sequence = new int[2000000];
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

        public int[] heapSort(Heap heap) {

            // return smallest element that was removed from heap
            int[] sortedArray = new int[2000000];
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

        // QUESTION 6:
        long startTime, endTime;
        int size = 64;

        int[] array = new int[size];
        Random rand = new Random();
        Heap heap = new Heap();

        System.out.print("testing on Heap Sort: ");

        for (int i = 0; i < size; i++) {
            array[i] = rand.nextInt();
        }

        for (int i = 0; i < size; i++) {
            heap.insert(array[i]);
        }

        startTime = System.nanoTime();
        heap.heapSort(heap);
        endTime = System.nanoTime();

        System.out.println((endTime - startTime) + " nanoseconds");

        System.out.print("testing on Merge Sort: ");

        for (int i = 0; i < size; i++) {
            array[i] = rand.nextInt();
        }

        // QUESTION 7
        startTime = System.nanoTime();
        mergeSort(array, size);
        endTime = System.nanoTime();

        System.out.println((endTime - startTime) + " nanoseconds");

        System.out.print("testing on Insertion Sort: ");

        for (int i = 0; i < size; i++) {
            array[i] = rand.nextInt();
        }

        startTime = System.nanoTime();
        insertionSort(array, size);
        endTime = System.nanoTime();

        System.out.println((endTime - startTime) + " nanoseconds");

        System.out.print("testing on Quick Sort: ");

        for (int i = 0; i < size; i++) {
            array[i] = rand.nextInt();
        }

        startTime = System.nanoTime();
        quickSort(array, 0, size - 1);
        endTime = System.nanoTime();

        System.out.println((endTime - startTime) + " nanoseconds");
    }
}