import java.util.Scanner;

class Heap {

    int[] sequence = new int[100];
    int size = 1;

    Heap() {
    }

// Best Case: O(1) when newly added elements is greater than or equal to its parent. While loop will not run.
// Worst Case: (O(logn)) when new element added is smaller then its parent so it needs to be swapped.
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

// Best Case: (O(n)) where heap only has one element or already in a complete binary shape, elements are in correct order, loop occurs once.
// Worst Case: (O(logn)) where heap is unsorted and has to be remade from botton up, so while loop is executed logn times to move element to proper position.
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

    // return smallest element
    public int min() {
        return sequence[1];
    }

    // return size
    public int size() {
        return size - 1;
    }

    // if heap is empty or not
    public boolean isEmpty() {
        return size == 1;
    }
}

// Peusdocode for insert:
//      add the new element to the end of the heap
//      add num to the end of the sequence
//      place = index of the new element
//      while the new element is not at the root and its parent is greater than it
//      while place > 1 and sequence[parent(place)] > sequence[place]:
//          swap the new element with its parent
//          swap sequence[place] with sequence[parent(place)]
//          update the position of the new element
//          place = parent(place)
//------------------------------------------------------------------------------------------------------------------
// Peusdocode for removeMin:
//    Get the smallest element in the heap and remove it, decrement the size
//    num = sequence[1]
//    temp = null
//    size = size - 1

//    Move the last element to the root position which was where the smallest element was. This removes that element.
//    sequence[1] = sequence[size]

//    Starting at the root, continue until we reach the end of the heap.
//    place = 1
//    while (place * 2 < size):
//      Check which child of the current node is smaller
//       if sequence[place * 2] < sequence[place * 2 + 1]:
//          child = place * 2
//       else:
//          child = place * 2 + 1
        
//    Check if the child is smaller than the current node. If it is, swap the values.
//       if sequence[child] < sequence[place]:
//          temp = sequence[place]
//          sequence[place] = sequence[child]
//          sequence[child] = temp
        
//     Continue sinking the element down the heap until it reaches the proper position.
//     place = child

//   Return smallest element that was removed from heap
//   return num
//------------------------------------------------------------------------------------------------------------------
// Peusdocode for heapSort:
//      create an array called sortedArray with size 100
//      set length variable to heap's size
    
// loop through heap, removing smallest value and storing it in sortedArray
// for i from 0 to length - 1:
//      sortedArray[i] = heap.removeMin()
    
// return sortedArray