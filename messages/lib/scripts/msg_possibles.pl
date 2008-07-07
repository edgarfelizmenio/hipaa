#!/usr/sweet/bin/perl

# Perl trim function to remove whitespace from the start and end of the string
sub trim($)
{
    my $string = shift;
    $string =~ s/^\s+//;
    $string =~ s/\s+$//;
    return $string;
}

$line = <STDIN>;

# Get variables
$varStart = index($line, "=");
$varStart = rindex($line, ';', $varStart) + 2;

$varEnd = rindex($line, '=');
$varEnd = rindex($line, ' ', $varEnd - 1) - 2;

$varString = substr ($line, $varStart, $varEnd - $varStart);

#print 'variables:' . $varString . ":\n";

#print "\n";

$count = 0;
$start = 0;
$end = index($varString, ' =', $start);
while ($end != -1 && $start != -1) {
  $count++;
  $var = trim(substr($varString, $start, $end - $start));
  push (@vars, $var);
  $start = index($varString, ' ', $end + 3);
  $end = index($varString, ' =', $start);
}

#print "Variables asked for: \n";
for ($i=0; $i<@vars; $i++) {
#  print "  " . $vars[$i] . "\n";
}
# variables:X = _h122 Y = _h136:


# strip off front section
$start = index($line, 'L = ');
$line = substr $line, $start + 5;

# strip off end section
$end = index($line, ']');
$line = substr $line, 0, $end;

# take off the first 't' since we use it in split
$line = substr $line, 1;

# tokenized!
@predicates = split(/,t/, $line);
for my $predicate (@predicates) {
  # strip beginning and ending parentheses
  $predicate = substr $predicate, 1, length($predicate)-2;
#  print $predicate . "\n";

  @values = split(/,/, $predicate);

    for ($i=0; $i<@values; $i++) {
      $char = substr $values[$i], 0, 1;

      $boolName = 'any_' . $vars[$i];  
      $hashName = $vars[$i];
      if ($char eq '_') {
        # any_var set to true

        #$$boolName = 1;
        
        # clear the hash and add anything
        #%$hashName = ();
        #$$hashName{'anything'} = 1;
      } else {
        # only if any_var not set, then add to set
        if (!$$boolName) {
          $$hashName{$values[$i]} = 1;
        }
      }

 #     print $vars[$i] .' = ' .$values[$i] . "\n";    
    }


}

print "{";
$previous = 0;
for ($i=0; $i<@vars; $i++) {
  if ($previous) {
    print ", \n";
  }
  $previous = 1;
  print '"' . $vars[$i] .'"' .  ": {\"identifier\": \"name\",\n  \"items\": [  \n";
  $hashName = $vars[$i];
  $varName = $vars[$i];

#  print keys %$hashName;
  #print " keys.. " . keys %$tmp ;


    $prev = 0;
    for my $key ( keys %$hashName ) {
      if($prev) {
        print ", \n";
      }
      $prev = 1;
      print '      {"name": "' . $key . '"}';
    }

  print "\n   ]}";
}

print "\n}\n";

# %hash = (
#         A => 'value1',
#         B => 'value2',
#         C => 'value3',
#     );
#$hash{'E'} = ' value 5';
#$hashName = 'hash';
#$$hashName{'D'} = 'value4';
#print keys %$hashName;
#print "\n";





# L = [t(_h637,null),t(_h1167,null),t(carla,_h463),t(carla,_h543),t(carla,_h623),t(carla,_h668)]
#print STDOUT $line . "\n";

