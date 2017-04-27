<?php
namespace CakeMojo\Messages\Shell;

use Cake\Console\Shell;

/**
 * Messages shell command.
 */
class MessagesShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser()
            ->setDescription('Message management shell')
            ->addSubcommand('send', [
                'help' => 'Send a message to a given target',
                'parser' => [
                    'description' => '',
                    'arguments' => [
                        'table' => ['help' => 'Table name', 'required' => true],
                        'foreignKey' => ['help' => 'Foreign Key', 'required' => true],
                        'subject' => ['help' => 'Message subject', 'required' => true],
                        'body' => ['help' => 'Message body'],
                        ],
                    ],
                ]);

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->out($this->OptionParser->help());
    }

    /**
     * send() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function send($table, $foreignKey, $subject, $body = null)
    {
        $targetTable = loadModel($table);
        $targetTable->addMessage($foreignKey, compact('subject', 'body'));
    }
}
