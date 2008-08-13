%:- ['odbc.pl'].


% filter_list_any(Unfiltered, Filtered)
%  filters and replaces _h2345 type vars with anything
%  and then terminates recursion
filter_list_any([], []).
filter_list_any([H|T], [X|Y]) :-
	atom(H),
	H=X,
	filter_list(T,Y).
filter_list_any(_, [X|Y]) :-
        X='anything',
	Y = [].


% filter_list(Unfiltered, Filtered)
%  filters the list, skipping over _h234 type variables
filter_list([], []).
filter_list([H|T], [X|Y]) :-
	atom(H),
	H=X,
	filter_list(T,Y).
filter_list([_|T], L) :-
	filter_list(T, L).




