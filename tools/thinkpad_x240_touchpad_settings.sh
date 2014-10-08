#!/bin/bash
#This short bash script will set my preferences for the new Thinkpads x240 uni-touchpad.
#I did this because the buttons didn't work like expected in Kubuntu. For those who don't know,
#the new touchpad is a single pad that acts as a multi-gesture pad and can be clicked in the different areas
#like this:
#+-----------------+---------+------------------+
#|LeftTopCorner    | TopEdge | RightTopCorner   |
#|LeftEdge         | Middle  | RightEdge        |
#|LeftBottomCorner | Bottom  | RightBottomCorner|
#+-----------------+---------+------------------+
#This script sets the touch area to a small centered area, where gestures are working (for two-finger scrolling)
#disables all tap-buttons in this area (mouse movement is still working there)
#and splits the button areas in three columns. The touch-area is therefore in the center of the middle mouse button.
#
#This will make the new thinkpad usable, but it's still not as good as the old ones... heck, why use touchpads anyway?
#I want a new thinkpads with three mouse buttons and a red dot.
#
#Hope this script will help someone :) 
#PS: Should work for other thinkpads with the new touchpad as well. Haven't tested it, but will if you send me your TP ;)

echo "Setting ThinPad X240 Touchpad Synaptic Preferences..."

echo "Set touchpad to middle area below middle mouse button for dual finger scrollage"
synclient AreaLeftEdge=3000
synclient AreaRightEdge=4300
synclient AreaTopEdge=2000
synclient AreaBottomEdge=3900
echo "No Tap buttons in this area..."
xinput set-prop 10 "Synaptics Tap Action" 0 0 0 0 0 0 0

echo -e "Setting areas for three mouse buttons:\n
+--------+--------+--------+
|        | Middle |        |
|        | Mouse  |        |
|        |--------|        |
|  Left  | Scroll | Right  |
| Mouse  |  Area  | Mouse  |
|        |        |        |
|        |--------|        |
|        |        |        |
+--------+--------+--------+
Note, that the mouse button also works in the scroll area, but while the button is pressed the (normally disabled) mouse movement will work as well.
"
synclient RightButtonAreaLeft=0
synclient RightButtonAreaTop=0
synclient MiddleButtonAreaLeft=3000
synclient MiddleButtonAreaRight=4300
synclient RightButtonAreaLeft=4300
echo "Done :)"
