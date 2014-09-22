/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class MoveRoleCreate extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public int roleid;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 15 */     MoveRoleCreateArg arg = (MoveRoleCreateArg)argument;
/* 16 */     MoveRoleCreateRes res = (MoveRoleCreateRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 21 */     MoveRoleCreateArg arg = (MoveRoleCreateArg)argument;
/* 22 */     MoveRoleCreateRes res = (MoveRoleCreateRes)result;
/*    */ 
/* 24 */     synchronized (this)
/*    */     {
/* 26 */       this.retcode = res.retcode;
/* 27 */       this.roleid = res.roleid;
/* 28 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 34 */     synchronized (this)
/*    */     {
/* 36 */       this.retcode = 4;
/* 37 */       this.roleid = -1;
/* 38 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.MoveRoleCreate
 * JD-Core Version:    0.6.2
 */