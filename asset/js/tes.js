function getFixedCounter(k) {
    // write your code here
    return {
        increment: function () {  
            k++;
        }
        decrement: function () {  
            k--;
        }
        getvalue: function () {  
            return k;
        }
    }
  }


const o = getFixedCounter(2);

o.increment();