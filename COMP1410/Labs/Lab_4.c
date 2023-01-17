#include <stdio.h>
#include <string.h>
#include <assert.h>

int main(void) {
  
}
// select_max(str) returns a pointer to the character of maximal ASCII value
// in the string str (the first if there are duplicates)
// requires: str is a valid string , length(str) >= 1
char * select_max(char str[]){
    int length = strlen(str);
    if(length<1){
        return 0;
    }
    char *max = str;
    for(int i=0;i<length;i++){
        if(str[i] > max){
            max = str[i];
        }
    }
    return *max;
}

// str_sort(str) sorts the characters in a string in descending order
// requires: str points to a valid string that can be modified
void str_sort(char str[]);
  char str[], chTemp;
  int i, j, len;
  len = strlen(str);
    for(i=0;i<len;i++){
        for(j=0;j<(len-1);j++){
          if(str[j]<str[j+1]){
            chTemp = str[j];
            str[j] = str[j+1];
            str[j+1] = chTemp;
            }
        }
    }