%Remove writeln when we don't want to see messages.  Set writeln to an AND of true or fail.  
%True if we want to assume unimplemented portions of code pass.
%Fail if we want to assume unimplemented portions of code always fail.
debug(X) :-
  fail.
  %writeln(X).
