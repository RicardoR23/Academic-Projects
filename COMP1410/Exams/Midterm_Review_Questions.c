/* ===========================================================================
COMP-1410 Midterm Review Lab
=========================================================================== */
#include <stdio.h>
#include <assert.h>

// count_ones(n) returns the number of 1s in the decimal representation of n
// requires: 0 <= n < 10^9
int count_ones(int n);

// count_ones_up_to_n(n) returns how many 1s are in the decimal representation
// of the integers between 1 and n
// requires: 0 <= n < 10^5
int count_ones_up_to_n(int n);

// row_sums(n, m, matrix, sums) updates sums to contain the row sums of the
// given n by m matrix
// requires: 1 <= n <= 10, 1 <= m <= 10
// sums points to an array of length at least n

void row_sums(int n, int m, int matrix [][10], int * sums);

int main(void) {

  // Perform your tests here
  printf("All tests passed successfully.\n");
}

int count_ones(int n) {
  if (n == 0) {
    return 0;
  }
  
  if (n == 1) {
    return 1;
  }
  //1234 --> last_digit = 4

  int last_digit = n % 10; //the last digit of the number
  return (last_digit == 1) + count_ones(n/10);
  //if yes --> 1 + count_ones
  //if no --> 0 + count_ones

}
//11 -- > 4 (1, 10, 11)



int count_ones_up_to_n(int n) {
  if (n == 0) {
     return 0;
  }

  return count_ones(n) + count_ones_up_to_n(n - 1);
}

void row_sums(int n, int m, int matrix[][10], int * sums) {
  for (int i = 0; i < n; i++) {
    sums[i] = 0;
    for (int j = 0; j < m; j++) {
      sums[i] += matrix[i][j];
    }

  }

  /*
  123
  456
  789

  sums[0] = 0;
  sums[0] = 0 + 1 = 1
  sums[0] = 1 + 2 = 3
  sums[1] = 0;
  sums[1]
  */

  }

//count_ones(n) returns the number of 1s in the decimal representation of n
// requires: 0 <= n < 10^9
int count_ones(int n);

// count_ones_up_to_n(n) returns how many 1s are in the decimal representation
//  of the integers between 1 and n
// requires: 0 <= n < 10^5
int count_ones_up_to_n(int n);

// row_sums(n, m, matrix, sums) updates sums to contain the row sums of the
// given n by m matrix

// requires: 1 <= n <= 10, 1 <= m <= 10

//      sums points to an array of length at least n

void row_sums(int n, int m, int matrix [][10], int * sums);



int main(void) {

  // Perform your tests here

  int data [3][10] = {{1,2,3},{4,5,6},{7,8,9}};

  int sums [3] = {0, 0, 0};

  row_sums(3, 10, &data[0][0], &sums[0]);

   

  for (int i = 0; i < 3; i++) {

    for (int j = 0; j < 3; j++) {

      printf("%d ", data[i][j]);

    }

    puts("");

  }

   

  for (int i = 0; i < 3; i++) {

    printf("%d ", sums[i]);

  }

   

   

  printf("All tests passed successfully.\n");

   

   

}



int count_ones(int n) {

  if (n == 0) {

    return 0;

  }

   

  if (n == 1) {

    return 1;

  }

  //1234 --> last_digit = 4

   

  int last_digit = n % 10; //the last digit of the number

  return (last_digit == 1) + count_ones(n/10);

   

  //if yes --> 1 + count_ones

  //if no --> 0 + count_ones

}



//11 -- > 4 (1, 10, 11)



int count_ones_up_to_n(int n) {

  if (n == 0) {

     return 0;

  }

  return count_ones(n) + count_ones_up_to_n(n - 1);

}



void row_sums(int n, int m, int matrix[][10], int * sums) {

  for (int i = 0; i < n; i++) {

    sums[i] = 0;

    for (int j = 0; j < m; j++) {

      sums[i] += matrix[i][j];

    }

  }

   

  /*

  123

  456

  789

   

  sums[0] = 0;

  sums[0] = 0 + 1 = 1

  sums[0] = 1 + 2 = 3

  sums[1] = 0;

  sums[1]

   

  */

}
