<?php

class PostgreSQL
{
    public static function server_available($server = null){
        if(empty($server)){
            return false;
        }

        if(! extension_loaded('pgsql')){
            return false;
        }

        @pg_connect('host='.$server);
        $error = error_get_last();
        if($error AND ! stripos($error['message'], 'password')){
            return false;
        }

        return true;
    }

    public static function name(){
        return __CLASS__;
    }

    public static function connect($configs){
        if(empty($configs['host'])
            OR empty($configs['user'])
                OR empty($configs['pass'])){
            throw new Exception('Cannot connect with empty host');
        }

        // TODO: cannot run drop_database() with the dbname specified below.
        return pg_connect(
            'host='.$configs['host']
            .' user='.$configs['user']
            .' password='.$configs['pass']
            .' dbname='.Params::get('database')
        );
    }

    public static function select_database($database = null){
        return true;
    }

    public static function get_databases(){
        $databases = array();

        $results = pg_query(
            "SELECT *
                FROM pg_database
                WHERE datallowconn = 't'
                ORDER BY datname"
        );

        while($row = pg_fetch_row($results)){
            $databases[] = $row[0];
        }

        return $databases;
    }

    public static function get_tables($database){
        $tables = array();

        $results = pg_query(
            "SELECT
                tablename AS name
                FROM pg_catalog.pg_tables
                WHERE schemaname != 'pg_catalog'
                    AND schemaname != 'information_schema'
                ORDER BY name"
        );

        while($row = pg_fetch_assoc($results)){
            $tables[] = $row;
        }

        return $tables;
    }

    public static function get_columns($database, $table){
        $columns = array();

        // TODO: determine what information would be most useful to display
        $results = pg_query(
            "SELECT
                column_name AS field,
                collation_name AS collation,
                is_nullable AS null,
                column_default AS default
                FROM information_schema.columns
                WHERE table_name = '".self::escape($table)."'"
        );

        // $results = mysql_query(
        //     'SELECT
        //         column_name AS field,
        //         collation_name AS collation,
        //         column_type AS attributes,
        //         is_nullable AS null,
        //         column_default AS default,
        //         extra,
        //         column_key AS key
        //         FROM information_schema.columns
        //         WHERE table_schema = "'.self::escape($database).'"
        //             AND table_name = "'.self::escape($table).'"
        //         ORDER BY ordinal_position'
        // );

        while($row = pg_fetch_assoc($results)){
            // get the type from column_type instead of
            // data_type because it also includes the length
            // $attributes = explode(' ', $row['attributes']);
            // $row['type'] = array_shift($attributes);
            // $row['attributes'] = implode(' ', $attributes);
            //
            // $row['null'] = strtolower($row['null']) === 'yes';
            // $row['attributes'] = strtoupper($row['attributes']);
            // $row['extra'] = strtoupper($row['extra']);

            $columns[] = $row;
        }

        return $columns;
    }

    public static function get_rows(
        $database = null,
        $table = null,
        $order = null,
        $reverse = null,
        $limit = 30
    ){
        $rows = array();

        if(empty($database)){
            return false;
        }

        if(empty($table)){
            return false;
        }

        $query =
            'SELECT *
                FROM '.self::escape($table);

        if(! empty($order)){
            $query .= ' ORDER BY '.self::escape($order);
            if($reverse){
                $query .= ' DESC';
            }
        }

        if(! empty($limit)){
            $query .= ' LIMIT '.(int)$limit;
        }

        $results = pg_query($query);
        while($row = pg_fetch_assoc($results)){
            $rows[] = $row;
        }

        return $rows;
    }

    public static function query($query = null){
        $rows = array();
        if(! $results = pg_query($query)){
            return false;
        }
        while($row = pg_fetch_assoc($results)){
            $rows[] = $row;
        }
        return $rows;
    }

    public static function execute($query = null){
        return pg_query($query);
    }

    public static function drop_database($database = null){
        if(empty($database)){
            return false;
        }
        return pg_query(
            'DROP DATABASE '.self::escape($database)
        );
    }

    public static function drop_table($database = null, $table = null){
        if(empty($database) OR empty($table)){
            return false;
        }
        return pg_query('DROP TABLE '.self::escape($table));
    }

    public static function truncate_table($database = null, $table = null){
        if(empty($database) OR empty($table)){
            return false;
        }
        return pg_query('TRUNCATE TABLE '.self::escape($table));
    }

    public static function count($database, $query){

    }

    public static function escape($param){
        return $param;
    }

    public static function highlight($sql_raw = null){
        if(! is_string($sql_raw)){
            return false;
        }

        $sql_reserved_all = array(
            'ACCESSIBLE', 'ACTION', 'ADD', 'AFTER', 'AGAINST', 'AGGREGATE', 'ALGORITHM', 'ALL', 'ALTER', 'ANALYSE', 'ANALYZE', 'AND', 'AS', 'ASC',
            'AUTOCOMMIT', 'AUTO_INCREMENT', 'AVG_ROW_LENGTH', 'BACKUP', 'BEGIN', 'BETWEEN', 'BINLOG', 'BOTH', 'BY', 'CASCADE', 'CASE', 'CHANGE', 'CHANGED',
            'CHARSET', 'CHECK', 'CHECKSUM', 'COLLATE', 'COLLATION', 'COLUMN', 'COLUMNS', 'COMMENT', 'COMMIT', 'COMMITTED', 'COMPRESSED', 'CONCURRENT',
            'CONSTRAINT', 'CONTAINS', 'CONVERT', 'CREATE', 'CROSS', 'CURRENT_TIMESTAMP', 'DATABASE', 'DATABASES', 'DAY', 'DAY_HOUR', 'DAY_MINUTE',
            'DAY_SECOND', 'DEFINER', 'DELAYED', 'DELAY_KEY_WRITE', 'DELETE', 'DESC', 'DESCRIBE', 'DETERMINISTIC', 'DISTINCT', 'DISTINCTROW', 'DIV',
            'DO', 'DROP', 'DUMPFILE', 'DUPLICATE', 'DYNAMIC', 'ELSE', 'ENCLOSED', 'END', 'ENGINE', 'ENGINES', 'ESCAPE', 'ESCAPED', 'EVENTS', 'EXECUTE',
            'EXISTS', 'EXPLAIN', 'EXTENDED', 'FAST', 'FIELDS', 'FILE', 'FIRST', 'FIXED', 'FLUSH', 'FOR', 'FORCE', 'FOREIGN', 'FROM', 'FULL', 'FULLTEXT',
            'FUNCTION', 'GEMINI', 'GEMINI_SPIN_RETRIES', 'GLOBAL', 'GRANT', 'GRANTS', 'GROUP', 'HAVING', 'HEAP', 'HIGH_PRIORITY', 'HOSTS', 'HOUR', 'HOUR_MINUTE',
            'HOUR_SECOND', 'IDENTIFIED', 'IF', 'IGNORE', 'IN', 'INDEX', 'INDEXES', 'INFILE', 'INNER', 'INSERT', 'INSERT_ID', 'INSERT_METHOD', 'INTERVAL',
            'INTO', 'INVOKER', 'IS', 'ISOLATION', 'JOIN', 'KEY', 'KEYS', 'KILL', 'LAST_INSERT_ID', 'LEADING', 'LEFT', 'LEVEL', 'LIKE', 'LIMIT', 'LINEAR',
            'LINES', 'LOAD', 'LOCAL', 'LOCK', 'LOCKS', 'LOGS', 'LOW_PRIORITY', 'MARIA', 'MASTER', 'MASTER_CONNECT_RETRY', 'MASTER_HOST', 'MASTER_LOG_FILE',
            'MASTER_LOG_POS', 'MASTER_PASSWORD', 'MASTER_PORT', 'MASTER_USER', 'MATCH', 'MAX_CONNECTIONS_PER_HOUR', 'MAX_QUERIES_PER_HOUR',
            'MAX_ROWS', 'MAX_UPDATES_PER_HOUR', 'MAX_USER_CONNECTIONS', 'MEDIUM', 'MERGE', 'MINUTE', 'MINUTE_SECOND', 'MIN_ROWS', 'MODE', 'MODIFY',
            'MONTH', 'MRG_MYISAM', 'MYISAM', 'NAMES', 'NATURAL', 'NOT', 'NULL', 'OFFSET', 'ON', 'OPEN', 'OPTIMIZE', 'OPTION', 'OPTIONALLY', 'OR',
            'ORDER', 'OUTER', 'OUTFILE', 'PACK_KEYS', 'PAGE', 'PARTIAL', 'PARTITION', 'PARTITIONS', 'PASSWORD', 'PRIMARY', 'PRIVILEGES', 'PROCEDURE',
            'PROCESS', 'PROCESSLIST', 'PURGE', 'QUICK', 'RAID0', 'RAID_CHUNKS', 'RAID_CHUNKSIZE', 'RAID_TYPE', 'RANGE', 'READ', 'READ_ONLY',
            'READ_WRITE', 'REFERENCES', 'REGEXP', 'RELOAD', 'RENAME', 'REPAIR', 'REPEATABLE', 'REPLACE', 'REPLICATION', 'RESET', 'RESTORE', 'RESTRICT',
            'RETURN', 'RETURNS', 'REVOKE', 'RIGHT', 'RLIKE', 'ROLLBACK', 'ROW', 'ROWS', 'ROW_FORMAT', 'SECOND', 'SECURITY', 'SELECT', 'SEPARATOR',
            'SERIALIZABLE', 'SESSION', 'SET', 'SHARE', 'SHOW', 'SHUTDOWN', 'SLAVE', 'SONAME', 'SOUNDS', 'SQL', 'SQL_AUTO_IS_NULL', 'SQL_BIG_RESULT',
            'SQL_BIG_SELECTS', 'SQL_BIG_TABLES', 'SQL_BUFFER_RESULT', 'SQL_CACHE', 'SQL_CALC_FOUND_ROWS', 'SQL_LOG_BIN', 'SQL_LOG_OFF',
            'SQL_LOG_UPDATE', 'SQL_LOW_PRIORITY_UPDATES', 'SQL_MAX_JOIN_SIZE', 'SQL_NO_CACHE', 'SQL_QUOTE_SHOW_CREATE', 'SQL_SAFE_UPDATES',
            'SQL_SELECT_LIMIT', 'SQL_SLAVE_SKIP_COUNTER', 'SQL_SMALL_RESULT', 'SQL_WARNINGS', 'START', 'STARTING', 'STATUS', 'STOP', 'STORAGE',
            'STRAIGHT_JOIN', 'STRING', 'STRIPED', 'SUPER', 'TABLE', 'TABLES', 'TEMPORARY', 'TERMINATED', 'THEN', 'TO', 'TRAILING', 'TRANSACTIONAL',
            'TRUNCATE', 'TYPE', 'TYPES', 'UNCOMMITTED', 'UNION', 'UNIQUE', 'UNLOCK', 'UPDATE', 'USAGE', 'USE', 'USING', 'VALUES', 'VARIABLES',
            'VIEW', 'WHEN', 'WHERE', 'WITH', 'WORK', 'WRITE', 'XOR', 'YEAR_MONTH'
        );

        $sql_skip_reserved_words = array('AS', 'ON', 'USING');
        $sql_special_reserved_words = array('(', ')');

        $sql_raw = str_replace("\n", " ", $sql_raw);
        $sql_formatted = '';

        $prev_word = '';
        $word = '';

        for($i = 0, $j = strlen($sql_raw); $i < $j; $i++){
            $word .= $sql_raw[$i];
            $word_trimmed = trim($word);

            if($sql_raw[$i] == ' ' || in_array($sql_raw[$i], $sql_special_reserved_words)){
                $word_trimmed = trim($word);
                $trimmed_special = false;

                if(in_array($sql_raw[$i], $sql_special_reserved_words)){
                    $word_trimmed = substr($word_trimmed, 0, -1);
                    $trimmed_special = true;
                }

                $word_trimmed = strtoupper($word_trimmed);

                if(in_array($word_trimmed, $sql_reserved_all) && !in_array($word_trimmed, $sql_skip_reserved_words)){
                    if(in_array($prev_word, $sql_reserved_all)){
                        $sql_formatted .= '<b>'.strtoupper(trim($word)).'</b>'.'&nbsp;';
                    }
                    else {
                        $sql_formatted .= '<br/>&nbsp;';
                        $sql_formatted .= '<b>'.strtoupper(trim($word)).'</b>'.'&nbsp;';
                    }

                    $prev_word = $word_trimmed;
                    $word = '';
                }
                else {
                    $sql_formatted .= trim($word).'&nbsp;';
                    $prev_word = $word_trimmed;
                    $word = '';
                }
            }
        }

        return $sql_formatted . trim($word);
    }
}
