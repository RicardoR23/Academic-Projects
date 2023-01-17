/* ===========================================================================
COMP-1410 Lab 4
Ricardo Roufai: I have used ONE outside source which is the "swap_to_front" function given from the lab.
=========================================================================== */

#include <assert.h>
#include <stdio.h>
#include <string.h>

// swap_to_front(str, c) swaps the last character in the string str with the
// character pointed to by c
// requires: str is a valid string that can be modified, length(str) >= 1
// c points to a character in str
void swap_to_front(char str[], char * c){
  char temp = str[0];
  str[0] = *c;
  *c = temp;
}

// select_max(str) returns a pointer to the character of maximal ASCII value
// in the string str (the first if there are duplicates)
// requires: str is a valid string, length(str) >= 1
char * select_max(char str[]){
  char *men = str;
  int i = 0;
  while (i < strlen(str)){
    if (*men < str[i]){
      men = &str[i];
    }
    i++;
  }
  return men;
}

// str_sort(str) sorts the characters in a string in decending order
// requires: str points to a valid string that can be modified
void str_sort(char str[]){
  int i = 0;
  while (i < strlen(str)){
    char *men = select_max(&str[i]);
    swap_to_front(men, &str[i]);
    i++;
  }
}

int main(void){

  char first_string[] = "question";
  char second_string[] = "variable";
  char third_string[] = "mario";
  char fourth_string[] = "bowser";
  char fifth_string[] = "toadoryoshi";
  
  str_sort(first_string), str_sort(second_string),   
  str_sort(third_string), str_sort(fourth_string),
  str_sort(fifth_string);
  
  assert(*select_max("ricardo") == 'r');
  assert(*select_max("among") == 'o');
  assert(*select_max("youtube") == 'y');
  assert(*select_max("seven") == 'v');
  assert(*select_max("booster") == 't');

  assert(strcmp(first_string, "utsqonie") == 0);
  assert(strcmp(second_string, "vrliebaa") == 0);
  assert(strcmp(third_string, "romia") == 0);
  assert(strcmp(fourth_string, "wsroeb") == 0);
  assert(strcmp(fifth_string, "ytsroooihda") == 0);

  printf("All tests passed successfully.\n");
}