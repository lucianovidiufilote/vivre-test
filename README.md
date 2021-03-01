# Mighty Maze ( Vivre test )

### This is an app made for Vivre technical test.

#### Task:

1. Generate labyrinth based on input data
2. Find road from A to B
3. Save to Database
4. Build an UI to collect data and show the result
5. Animate path

#### Solution:

_*Entry point: src/MightyMaze.php: run()*_

#### How it was made:
1.
    * Generate one dimensional array with `dimX * dimY` size, filled with 0
    * Fill the array with `brickDensity` number of bricks
    * Shuffle the bricks
    * Generate matrix based on the one dimensional array
    * Put A and B in the matrix


2.
    * Explore all possible paths and find the shortest one -> `@todo: optimize algo, maybe use existing one`


3.
    * Database structure is in `/database` folder -> `@todo: install doctrine/dbal and really save to DB`


4.
    * Built using VUE.js && Bootstrap && Axios
    * All is in `index.html` -> `@todo: split in app.js and app.css`


5.
    * Add color to each `<td>` belonging to the path
    * Each `<td>` has `data-x` and `data-y` attributes that keep the coordinates, so the response JSON with steps is
      translated to each `<td>` 