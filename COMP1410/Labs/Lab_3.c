/* ===========================================================================
COMP-1410 Lab 3
Ricardo Roufai
I have used ONE outside source.
=========================================================================== */

#include <stdio.h>
#include <assert.h>
#include <stdbool.h>

// matrix_add(n, m, a, b, c) computes the sum of the matrices a and b;
// the result is stored in the matrix c
// requires: n >= 1, m >= 1
// a, b, and c point to the (0, 0) element of an n x m matrix
// the memory c points to can be modified
void matrix_add(const int n, const int m, const int *a, const int *b, int *c)
{
  for (int i=0; i < n; i++){
      for (int t=0; t < m; t++){
          *(c+m * i+t) = *(a+m * i+t) + *(b+m * i+t);
      }
  }
}

bool matrix_equals(const int n, const int m, const int *a, const int *b){
   const int * end_of_a = a+m*n;
   while (a < end_of_a){
     if(*a!=*b){
       return false;
     }
     ++a;
     ++b;
   }
  return true;
}

int main(void){
    int n = 3;
    int m = 5;
    int First[3][5] = {{2, 12, 4, 6, 10},
                       {24, 23, 11, 42, 24},
                       {124, 431, 231, 251, 731}};

    int Second[3][5] = {{4, 72, 51, 752, 21},
                        {121, 514, 1142, 146, 562},
                        {1245, 23, 5261, 123, 183}};

    int FirstTest[3][5] = {{6, 84, 55, 758, 31},
                           {145, 537, 1153, 188, 586},
                           {1369, 454, 5492, 374, 914}};

    int Third[3][5];
    assert(matrix_equals(3, 5, &FirstTest[0][0],&Third[0][0])==1);
    matrix_add(n, m, &First[0][0],&Second[0][0],&Third[0][0]);
    
    n = 5, m = 4;
    int Alpha[5][4] = {{2, 8, 3, 1246},
                       {124, 154, 33, 5231},
                       {1613, 626, 351, 1251},
                       {341, 315, 78, 2},
                       {151, 14, 2, 251}};

    int Beta[5][4] = {{2, 25, 235, 2351},
                      {1241, 732, 126, 236},
                      {72, 615, 235162, 23626},
                      {22, 1461, 22, 621},
                      {375, 65, 146, 15}};

    int SecondTest[5][4] = {{4, 33, 238, 3597},
                            {1365, 886, 159, 5467},
                            {1685, 1241, 235513, 24877},
                            {363, 1776, 100, 623},
                            {526, 79, 148, 266}};

    int Omega[5][4];
    assert(matrix_equals(5, 4, &SecondTest[0][0],&Omega[0][0])==1);
    matrix_add(n, m, &Alpha[0][0],&Beta[0][0],&Omega[0][0]);

    n = 6, m = 2;
    int Fourth[6][2] = {{4, 4},
                       {162, 124},
                       {2146, 6114},
                       {15, 512},
                       {927, 5125},
                       {19, 621}};

    int Fifth[6][2] = {{811, 2},
                       {4, 216},
                       {31, 8135},
                       {-813, 14},
                       {13571, 1371347},
                       {-134, 1571}};

    int ThirdTest[6][2] = {{815, 6},
                          {166, 340},
                          {2177, 14249},
                          {-798, 526},
                          {14498, 1376472},
                          {-115, 2192}};

    int Sixth[6][2];
    assert(matrix_equals(6, 2, &ThirdTest[0][0],&Sixth[0][0])==1);
    matrix_add(n, m, &Fourth[0][0],&Fifth[0][0],&Sixth[0][0]);
               
  printf("All tests passed successfully.\n");
}