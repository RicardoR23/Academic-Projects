/* ===========================================================================
COMP-1410 Assignment 2
Ricardo Roufai - I have NOT used any outside sources
=========================================================================== */

#include <ctype.h>
#include <stdio.h>
#include <assert.h>
#include <string.h>
#include <stdbool.h>

/////////////////////////////////////////////////////////////////////////////////////////

// make_move(board, column, player) updates the board following a move
// by the given player in the given column; returns false if the move
// was illegal because the column was full
// requires: 0 <= column < 7
// player is either 'X' or 'O'
bool make_move(char board[6][7], int column, char player){
  if(board[0][column] != '|'){
    printf("Aye buddy, illegal move!");
    return 0;
  }
  
  if(column < 0){
    return 0;
  if(column >= 7)
    return 0;
  }

  int j = 5;
  while(j > -1){
    if(board[j][column] == '|'){
      j--;
      board[j][column] = player;
      break;
    }
  }
  
  if(player == 'X'){
    printf("Are you ready to rumble??\nPress X to play as Player X.\n");}
  else{
    printf("Player O is superior!\nPress O to play as Player O.\n");
  }

  int w = 0;
  while(w < 6){
    int k = 0;
    while(k < 7){
      w++, k++;
      printf(" %c ", board[j][k]);
    }
      printf("\n");
  }
    return 1;
}

/////////////////////////////////////////////////////////////////////////////////////////

// check_win(board) returns true if the given player has 4 connected
// pieces on the board
bool check_win(char board[6][7], char player){
  int temp, vert = 0;
    while(vert < 6){
    vert++;
  int column = 0;
      while(column < 7){
        column++;
        if(board[vert][column] == '|'){
          temp++;
          break;
        }
      }
    }
  if(temp == 0){
    printf("Wow! A tie-game!");
    return false;
  }
  return false;
}

/////////////////////////////////////////////////////////////////////////////////////////

// first_capital(str, n) returns the first capital letter in str;
// returns 0 if str contains no capital letters
// requires: str is a string of length n
// str contains only lower -case and upper -case letters
// all lower-case letters appear before upper-case letters
char first_capital(const char str[], int n) {
int last = n - 1;
char uppercase = '0';
int  i = 1;

  int first = 0;
  if (first <= last){
    int half = (last - first)/2 + first;
      if ((str[half] >= 65) && (str[half] <= 90)){
        last = half - i;
        return uppercase = str[half];
      }
        else if ((str[half] >= 97))
          first = half + i;
            if (str[half] <= 122)
            first = half + i;
        else return uppercase;
  }
  if ((str[i] >= 97) && (str[i] <= 122))
    return '0';
}

/////////////////////////////////////////////////////////////////////////////////////////

// deepest_substring(str, out) updates out to be the deepest substring of
// str; the first is used if multiple possibilities exist
// requires:
// str is a string with balanced parenthesis
// out points to enough memory to store the deepest substring of str
void deepest_substring(const char str[], char out[]){
int layer = 0;
int deepest = 0;
int first = -1;
int last = -1;
int j = 0;

  while(j < str){
    if (str[j] == '('){
      layer++;
      while(deepest < layer){
        layer = deepest;
        first = j+1;}
    } 
      
  if(str[j]==')') {
    if (layer == deepest)
      while(first > last)
          break;
          last = j-1; 
      layer--;
      break;}
    j++;
  }
  
 strncpy(out, str + first, last - first + 1), out[1 + last - first] = '\0';
  
}

/////////////////////////////////////////////////////////////////////////////////////////

int main(void){
  int turn;
  char action = 'X';
  char board[6][7] = {{'|', '|', '|', '|', '|', '|', '|',}, 
                      {'|', '|', '|', '|', '|', '|', '|',}, 
                      {'|', '|', '|', '|', '|', '|', '|',}, 
                      {'|', '|', '|', '|', '|', '|', '|',}, 
                      {'|', '|', '|', '|', '|', '|', '|',}, 
                      {'|', '|', '|', '|', '|', '|', '|',}}; 
  for(int i = 0; i < 6; i++){
    for(int j = 0; j < 7; j++){
      printf(" %c ", board[i][j]);
    }
      printf("\n");
    }

  while(!check_win(board, 'X') && !check_win(board, 'O')){
  puts("Press a number from 0-6 please");
  scanf("%d", &turn);

    if(turn < 0 || turn >= 7){
      puts("Stop it, thats an invalid entry!\n");
    }
    
    if(turn >= 0 && turn < 7){
      make_move(board, turn, action);
        if(action == 'X'){
          action = 'O';
        }
          else if(action == 'O'){
            action = 'X';
          }
    }
  }
  char secondboard[6][7] = {{'|', 'O', 'O', 'O', 'O', '|', '|',}, 
                            {'|', '|', '|', '|', '|', '|', '|',}, 
                            {'|', '|', '|', '|', '|', '|', '|',}, 
                            {'|', '|', '|', '|', '|', '|', '|',}, 
                            {'|', '|', '|', '|', '|', '|', '|',}, 
                            {'|', '|', '|', '|', '|', '|', '|',}};
  assert(check_win(secondboard, 'O'));
  char thirdboard[6][7] = {{'|', '|', '|', '|', '|', '|', '|',}, 
                           {'X', '|', '|', '|', '|', '|', '|',}, 
                           {'X', '|', '|', '|', '|', '|', '|',}, 
                           {'X', '|', '|', '|', '|', '|', '|',}, 
                           {'X', '|', '|', '|', '|', '|', '|',}, 
                           {'|', '|', '|', '|', '|', '|', '|',}};
  assert(check_win(thirdboard, 'X'));
  char fourthboard[6][7] = {{'|', '|', '|', '|', '|', '|', '|',}, 
                            {'|', '|', '|', '|', '|', '|', '|',}, 
                            {'|', '|', '|', '|', '|', '|', 'X',}, 
                            {'|', '|', '|', '|', '|', 'X', '|',}, 
                            {'|', '|', '|', '|', 'X', '|', '|',}, 
                            {'|', '|', '|', 'X', '|', '|', '|',}};
  assert(check_win(fourthboard, 'X'));
  char fifthboard[6][7] = {{'|', '|', '|', '|', '|', '|', '|',}, 
                           {'|', '|', '|', '|', '|', '|', '|',}, 
                           {'|', '|', '|', 'O', '|', '|', '|',}, 
                           {'|', '|', '|', '|', 'O', '|', '|',}, 
                           {'|', '|', '|', '|', '|', 'O', '|',}, 
                           {'|', '|', '|', '|', '|', '|', 'O',}};
  assert(check_win(fifthboard, 'O'));
  char sixthboard[6][7] = {{'X', 'O', 'X', 'O', 'X', 'O', 'X',}, 
                           {'O', 'X', 'O', 'X', 'O', 'X', 'O',}, 
                           {'O', 'X', 'O', 'X', 'O', 'X', 'O',}, 
                           {'X', 'O', 'X', 'O', 'X', 'O', 'X',}, 
                           {'O', 'X', 'O', 'X', 'O', 'X', 'O',}, 
                           {'O', 'X', 'O', 'X', 'O', 'X', 'O',}};
  assert(!check_win(sixthboard, 'X'));

/////////////////////////////////////////////////////////////////////////////////////////

  assert(first_capital("spiderMan", 9) == 'M'),         
  assert(first_capital("petaR", 5) == 'R'), 
  assert(first_capital("heheheHAW", 9) == 'H'), 
  assert(first_capital("tobeyMaguire", 12) == 'M'), 
  assert(first_capital("ottooctavious", 11) == '0');

/////////////////////////////////////////////////////////////////////////////////////////

  char out[6];
  deepest_substring("c+(a-c)+a*a", out), assert(strcmp(out, "a-c") == 0),
  deepest_substring("((a-4)))+d(s)*2*2(23))/2))", out),
  assert(strcmp(out, "a-4") == 0),
  deepest_substring("(()(())()())(()())))))))(()))", out),
  assert(strcmp(out, "") == 0),
  deepest_substring("e+3%2/2(21-4/2))(2)((d))", out),
  assert(strcmp(out, "21-4/2") == 0),
  deepest_substring("(5+2-2)(4/2)*2(a-f-1)))))", out),
  assert(strcmp(out, "5+2-2") == 0);
  printf("All tests passed successfully\n");
}
  
/////////////////////////////////////////////////////////////////////////////////////////
