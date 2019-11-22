/*

Problem ->

Given 3 String at most of 10 Alphabets and 3 Integer from 0 to 999. Print following output for given input. Every String needs to be 15
characters long. So for given String keep adding trailing spaces to make it 15 string long. Also every Integer needs to be 3 digits. Thus
given Integer has heading 0 if and only if given integer is not a 3 digits number.

Test Case:

    Input:
           Anim 200
           Akash 1
           AnimAkash 24
          
  Output:
          ================================
          Anim            200
          Akash           001
          AnimAkash       024
          ================================
*/

import java.util.*;

public class JavaStringOutputFormat {

    public static void main(String[] args) {

        Scanner scan = new Scanner(System.in);

        String[] stringInput = new String[3];

        int[] integerInput = new int[3];

        for (int i = 0; i < 3; i++) {

            stringInput[i] = scan.next();

            integerInput[i] = scan.nextInt();
        }

        scan.close();

        System.out.println("===============================");

        for (int i = 0; i < 3; i++) {

            int length = stringInput[i].length();

            String string = "";

            while (length <= 15) {

                string = string.concat(" ");

                length++;
            }

            stringInput[i] = stringInput[i].concat(string);

            if (integerInput[i] < 100 && integerInput[i] >= 10) {

                System.out.println(stringInput[i] + "0" + integerInput[i]);

            } else if (integerInput[i] < 10) {

                System.out.println(stringInput[i] + "00" + integerInput[i]);

            } else {

                System.out.println(stringInput[i] + integerInput[i]);
            }
        }

        System.out.print("================================");
    }
}
