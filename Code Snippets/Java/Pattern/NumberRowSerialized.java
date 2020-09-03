/*

Problem ->

Given n number of rows, show number serially from 1 to continuously until rows' count expire.
Test Case:

	n = 9
	
	1
	2 3
	4 5 6
	7 8 9 10
	11 12 13 14 15
	16 17 18 19 20 21
	22 23 24 25 26 27 28
	29 30 31 32 33 34 35 36
	37 38 39 40 41 42 43 44 45    
*/


public class NumberRowSerialized {
    public static void main(String [] args) {
        int n = 20;

        int num = 0;

        for(int i = 1; i <= n; i++) {

            for(int j = 1; j <= i; j++) {
                num++;

                System.out.print(num);

                System.out.print(" ");
            }

            if(i < n) {
                System.out.println();
            }
        }
    }
}