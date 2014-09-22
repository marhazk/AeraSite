/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class Uid2Logicuid extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public int logicuid;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 15 */     Uid2LogicuidArg arg = (Uid2LogicuidArg)argument;
/* 16 */     Uid2LogicuidRes res = (Uid2LogicuidRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 21 */     Uid2LogicuidArg arg = (Uid2LogicuidArg)argument;
/* 22 */     Uid2LogicuidRes res = (Uid2LogicuidRes)result;
/*    */ 
/* 24 */     synchronized (this)
/*    */     {
/* 26 */       this.retcode = res.retcode;
/* 27 */       this.logicuid = res.logicuid;
/* 28 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 34 */     synchronized (this)
/*    */     {
/* 36 */       this.retcode = 4;
/* 37 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.Uid2Logicuid
 * JD-Core Version:    0.6.2
 */